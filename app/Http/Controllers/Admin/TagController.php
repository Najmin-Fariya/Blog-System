<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tags = Tag::latest()->get();
        return view('admin.tag.index',['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required',
        ]);
        
        $tag = new Tag();
        $tag->tagName = $request->tagName;
        $tag->slug = str_slug($request->tagName);
        $tag->save();
        
        Toastr::success('Tag added successfully', 'success');
        //return redirect()->back();
        return redirect()->route('admin.tag.index')->with('message','Data saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::find($id);
//        return $tag;
        return view('admin.tag.edit',['tags'=>$tags]);
        
    }

    
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->tagName = $request->tagName;
        $tag->tagName = str_slug($request->tagName);
        $tag->save();
        Toastr::success('Data Updated successuflly','Success');
        return redirect()->route('admin.tag.index');
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        Toastr::success('Data successfully deleted','success');
        return redirect()->back();
        
    }
   
    }
