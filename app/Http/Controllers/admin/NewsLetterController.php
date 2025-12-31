<?php

namespace App\Http\Controllers\admin;

use App\Models\news_letter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterController extends Controller
{
    function _construct()
    {
        $this->middleware('permission:newsletter-list|newsletter-create|newsletter-edit|newsletter-delete' , ['only' => ['index','store']]);
        $this->middleware('permission:newsletter-create' , ['only' => ['create','store']]);
        $this->middleware('permission:newsletter-edit' , ['only' => ['edit','update']]);
        $this->middleware('permission:newsletter-delete' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query=news_letter::orderby('id' , 'desc')->where('id' ,'>' , 0);
            if($request['search'] != ""){
                $query->where('email', 'like', '%'. $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status']==0;
                }
                $query->where('status' ,$request['status']);
            }
            $news_letters=$query->paginate(10);
            return (string) view('admin.news_letter.search' , compact('news_letters'));
        }

        $page_title= 'All News Letter';
        $news_letters = news_letter::orderby('id' , 'desc')->paginate(10);
        return view('admin.news_letter.index' , compact('news_letters', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title= "Add News_letter";
        return view('admin.news_letter.create' , compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /* if($request->email==''){
            return '3';
        } */
        $validator = $request->validate([
            'email' => 'required|max:30',
        ]);

        $model = news_letter::where('email', $request->email)->first();

        /* if(!empty($model)){
            return '2';
        }else{ */
            $news_letters = new news_letter();
            $news_letters->email = $request->email;
            $news_letters->save();
            return redirect()->back()->with('message', 'Email send Successfully !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\news_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function show(news_letter $news_letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title= "Edit News_letter";
        $news_letters=news_letter::where('id' , $id)->first();
        return view('admin.news_letter.edit' , compact('page_title' , 'news_letters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = news_letter::where('id', $id)->first();
        $validator = $request->validate([
            'email' => 'required',
        ]);
        // $updates->name = $request->name;
        $updates->email = $request->email;
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('newsletter.index')->with('message' , 'Newsletter updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news_letters=news_letter::where('id' , $id)->first();
        if($news_letters){
            $news_letters->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
