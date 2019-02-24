<?php

namespace App\Http\Controllers\Author;

use App\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\AuthorPostNotification;
use Illuminate\Support\Facades\Notification;
use App\User;
class AuthorPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author.authorPost.authorPostIndex',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ctegories = Category::all();
        $tags      = Tag::all();
        return view('author.authorPost.createAuthorPost',['categories'=>$ctegories,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'categories' =>'required',
            'tags' =>'required',
            'postBody' =>'required'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
            //make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //check category directory is exist?
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //resize image category and upload

            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImage);

        } else {
            $imageName = "default.png";
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->postBody;
        
        if(isset($request->status))
        {
           $post->status = true;  
        }else{
           $post->status = false;  
        }
        $post->is_approved = false; 
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        
        $users = User::where('role_id','1')->get();
        Notification::send($users,new AuthorPostNotification($post));
        
        Toastr::success('post added successfully','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized to this page','error');
            return redirect()->back();
        }
        return view('author.authorPost.showAuthorPost',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized to this page','error');
            return redirect()->back();
        }
        $ctegories = Category::all();
        $tags      = Tag::all();
        return view('author.authorPost.editAuthorPost',['post'=>$post,'categories'=>$ctegories,'tags'=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized to this page','error');
            return redirect()->back();
        }
        
        $this->validate($request,[
            'title' =>'required',
            'image' => 'image',
            'categories' =>'required',
            'tags' =>'required',
            'postBody' =>'required'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
            //make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //check category directory is exist?
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //delete old post image
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImage);

        } else {
            $imageName = $post->image;
        }
        
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->postBody;
        
        if(isset($request->status))
        {
           $post->status = true;  
        }else{
           $post->status = false;  
        }
        $post->is_approved = false; 
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        
        Toastr::success('post Updated successfully','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized to this page','error');
            return redirect()->back();
        }
        
        if(Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
//        return $post;
        Toastr::success('Post Deleted successfully','Success');
        return redirect()->back();
    }
}
