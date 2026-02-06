<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\CarType;
use App\Models\ProductDetail;
use App\Models\Banner;
use App\Models\ProductImage;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete' , ['only' => ['index' , 'store']]);
        $this->middleware('permission:product-create' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:product-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:product-delete' , ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Product::orderby('id' , 'desc')->where('id' , '>' , 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%');
            }
            if($request['status'] != 'All'){
                if($request['status']==2){
                    $request['status']== 0;
                }
            $query->where('status' , $request['status']);
            }
            $models= $query->paginate(10);
            return (string) view('admin.product.search' , compact('models'));
        }
        $page_title = 'All Products';
        $models = Product::orderby('id' , 'desc')->paginate(10);
        return view('admin.product.index' , compact('models' , 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add New Product';
        $categories = Category::where('status' , 1)->get();
        $car_types = CarType::where('status' , 1)->get();
        $cities = City::where('status', 1)->get();
        return view('admin.product.create' , compact('page_title' , 'categories' , 'car_types', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->category_slug=='property'){
            $validator=$request->validate([
                'name' => 'required|unique:products,name|max:255',
                'description' => 'required|max:1000',
                'rent_per_day' => 'required|max:255',
                'category_slug' => 'required|max:255',
                'rooms' => 'required|max:5',
                'beds' => 'required|max:5',
                'bathrooms' => 'required|max:5',
                'address' => 'max:500',
            ]);
        }else{
            $validator=$request->validate([
                'name' => 'required|unique:products,name|max:255',
                'description' => 'required|max:1000',
                'rent_per_day' => 'required|max:255',
                'category_slug' => 'required|max:255',
                'car_type_slug' => 'required|max:255',
                'seats' => 'required|max:100',
                'doors' => 'required|max:10',
                'mpg' => 'required|max:255',
                'fuel' => 'required|max:255',
                'address' => 'max:500',
            ]);
        }

        $model =  new Product();
        if(isset($request->thumbnail)){
            $photo= date('YmdHis').'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $request->thumbnail->move(public_path('/admin/assets/products/thumbnails'), $photo);
            $model->thumbnail = $photo;
        }

        $model->created_by = Auth::user()->id;
        $model->category_slug = $request->category_slug;
        $model->name = $request->name;
        $model->slug = \Str::slug($request->name);
        $model->description = $request->description;
        $model->rent_per_day = $request->rent_per_day;
        $model->city_id = $request->city_id;
        $model->state_id = $request->state_id;
        $model->address = $request->address;
        $model->save();

        if($model)
        {
            $product_details = new ProductDetail();
            $product_details->product_id = $model->id;
            if($request->category_slug=='property'){
                $product_details->rooms = $request->rooms;
                $product_details->beds = $request->beds;
                $product_details->bathrooms = $request->bathrooms;
            }else{
                $product_details->car_type_slug = $request->car_type_slug;
                $product_details->color = $request->color;
                $product_details->seats = $request->seats;
                $product_details->doors = $request->doors;
                $product_details->mpg = $request->mpg;
                $product_details->fuel = $request->fuel;
            }
            $product_details->save();
        }
        if($product_details && isset($request->images))
        {
            if ($files=$request->file('images')) {
                foreach($files as $file){
                    $photo = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/admin/assets/products/images'), $photo);

                    ProductImage::create([
                        'product_id' => $model->id,
                        'image' => $photo,
                    ]);
                }
            }
        }

        return redirect()->route('product.index')->with('message' , 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $products = Product::where('category_slug', $slug)->where('status', 1)->paginate(6);
		$banner=Banner::where('name','ALL PRODUCTS')->first();
        return view('website.product.show', compact('products' , 'banner'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page_title = 'Edit Product';
        $categories=Category::where('status' , 1)->get();
        $car_types=CarType::where('status' , 1)->get();
        $details = Product::where('slug' , $slug)->first();
        $cities = City::where('status', 1)->get();
        $states = State::where('city_id', $details->city_id)->get();
        return view('admin.product.edit' , compact('page_title' , 'categories' , 'car_types' ,'details', 'cities', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if($request->category_slug=='property'){
            $validator=$request->validate([
                'description' => 'required|max:1000',
                'rent_per_day' => 'required|max:255',
                'category_slug' => 'required|max:255',
                'rooms' => 'required|max:5',
                'beds' => 'required|max:5',
                'bathrooms' => 'required|max:5',
                'address' => 'max:500',
            ]);
        }else{
            $validator=$request->validate([
                'description' => 'required|max:1000',
                'rent_per_day' => 'required|max:255',
                'category_slug' => 'required|max:255',
                'car_type_slug' => 'required|max:255',
                'seats' => 'required|max:100',
                'doors' => 'required|max:10',
                'mpg' => 'required|max:255',
                'fuel' => 'required|max:255',
                'address' => 'max:500',
            ]);
        }

        $model =  Product::where('slug', $slug)->first();
        if(isset($request->thumbnail)){
            $photo= date('YmdHis').'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $request->thumbnail->move(public_path('/admin/assets/products/thumbnails'), $photo);
            $model->thumbnail = $photo;
        }

        $model->created_by = Auth::user()->id;
        $model->category_slug = $request->category_slug;
        $model->name = $request->name;
        $model->slug = \Str::slug($request->name);
        $model->description = $request->description;
        $model->rent_per_day = $request->rent_per_day;
        $model->city_id = $request->city_id;
        $model->state_id = $request->state_id;
        $model->address = $request->address;
        $model->update();

        if($model)
        {
            $product_details = ProductDetail::where('product_id', $model->id)->first();
            if($request->category_slug=='property'){
                $product_details->rooms = $request->rooms;
                $product_details->beds = $request->beds;
                $product_details->bathrooms = $request->bathrooms;
            }else{
                $product_details->car_type_slug = $request->car_type_slug;
                $product_details->color = $request->color;
                $product_details->seats = $request->seats;
                $product_details->doors = $request->doors;
                $product_details->mpg = $request->mpg;
                $product_details->fuel = $request->fuel;
            }
            $product_details->update();
        }
        if($product_details && isset($request->images))
        {
            if ($files=$request->file('images')) {
                foreach($files as $file){
                    $photo = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/admin/assets/products/images'), $photo);

                    ProductImage::create([
                        'product_id' => $model->id,
                        'image' => $photo,
                    ]);
                }
            }
        }

        return redirect()->route('product.index')->with('message' , 'Product Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $model = Product::where('slug', $slug)->delete();
        if ($model) {
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }

    public function removeImage(Request $request)
    {
        $model = ProductImage::where('id', $request->product_image_id)->delete();
        if($model){
            return true;
        }else{
            return false;
        }
    }
    public function search(Request $request){
        $search = '';
		$banner=Banner::where('name','Searched ...')->first();
        if(isset($request->search)){
            $search = $request->search;
            $products = Product::where('name', 'like', '%'. $request->search .'%')->where('status', 1)->get();
            return view('website.product.search', compact('products', 'search' , 'banner'));
        }
        if($request->product_category_id=='property'){
            $products = Product::where('category_slug', $request->product_category_id)->where('city_id', $request->city_id)->where('state_id', $request->state_id)->where('status', 1)->get();
        }else{
            $products = Product::where('category_slug', '!=', 'property')->where('city_id', $request->city_id)->where('state_id', $request->state_id)->where('status', 1)->get();
        }


        return view('website.product.search', compact('products' , 'banner'));
    }
}
