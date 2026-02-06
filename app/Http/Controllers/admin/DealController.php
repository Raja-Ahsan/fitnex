<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        $this->middleware('permission:deals-list|deals-create|deals-edit|deals-delete' , ['only' => ['index','store']]);
        $this->middleware('permission:deals-create' , ['only' => ['create','store']]);
        $this->middleware('permission:deals-edit' , ['only' => ['edit','update']]);
        $this->middleware('permission:deals-delete' , ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query=Deal::orderby('id' , 'desc')->where('id' , '>' , 0);
            if($request['search'] != ""){
                $query->where('deal_name' , 'like' , '%' . $request['search'] .'%');
            }
            if($request['status'] != 'All'){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status' , $request['status']);
            }
            $deals=$query->paginate(10);
            return (string) view('admin.deals.search' , compact('deals'));
        }

        $page_title='All Deals';
        $deals=Deal::orderby('id' , 'desc')->paginate(10);
        return view('admin.deals.index' , compact('deals' , 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title='Add Deals';
        $categories=Category::where('status' , 1)->get();
        return view('admin.deals.create' , compact('page_title' , 'categories'));
    }

    public function getproducts(Request $request){
        $category=Category::where('id' , $request->category)->first();
        if($category->name == 'Property'){
                $property=Product::where('category_slug' , 'property')->get();
                return response()->json($property);
        }
        elseif($category->name == 'Rental'){
            $rental=Product::where('category_slug' , 'rental')->get();
                return response()->json($rental);
        }
        elseif($category->name == 'Recreational vehicle (R.V)'){
            $rvs=Product::where('category_slug' , 'recreational-vehicle')->get();
            return response()->json($rvs);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'deal_name' => 'required',
            'price' => 'required',
        ]);

        $deals= new Deal();

        
        $deals->created_by = Auth::user()->id;
        $deals->deal_name = $request->deal_name;
        $deals->category = $request->category;
        $deals->deal_product = $request->deal_product;
        $deals->price = $request->price;
        $deals->start_date = $request->start_date;
        $deals->end_date = $request->end_date;
        $deals->save();

        if($deals){
            $product = Product::where('id', $request->deal_product)->first();
            $product->is_deal = 1;
            $product->save();
        }

        return redirect()->route('deals.index')->with('message' , 'Deal Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deal  $deals
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {
        $page_title = 'Edit Deal';
        $deals=Deal::where('id' , $id)->first();
        $category = Category::where('id' , $deals->category)->first();
        $products = Product::where('category_slug', $category->slug)->get();
        
        $categories=Category::where('status' , 1)->get();
        return view('admin.deals.edit' , compact('categories' , 'page_title' , 'deals' , 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validator = $request->validate([
        //     'deal_name' => 'required',
        //     'price' => 'required',
        // ]);

        $product = Product::where('id', $request->deal_product)->first();
        $product->is_deal = 0;
        $product->update();
            
        $update=Deal::where('id' , $id)->first();
        
        $update->created_by = Auth::user()->id;
        $update->deal_name = $request->deal_name;
        $update->category = $request->category;
        $update->deal_product = $request->deal_product;
        $update->price = $request->price;
        $update->start_date = $request->start_date;
        $update->end_date = $request->end_date;
        $update->status = $request->status;
        $update->update();
        
        if($update){
            $product = Product::where('id', $request->deal_product)->first();
            $product->is_deal = 1;
            $product->update();
        }

        return redirect()->route('deals.index')->with('message' , 'Deal Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deals= Deal::where('id' , $id)->first();
        if($deals){
            $deals->delete();
            return true;
        }else{
            return response()->json(['message' => 'Failed'],404);
        }
    }
}
