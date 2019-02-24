<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AuthorPostApprove;
use App\Subscriber;

use Illuminate\Notifications\Notification;
use App\Notifications\NewPostNotifyToSubscriber;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.postIndex',['posts'=>$posts]);
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
        return view('admin.post.createPost',['categories'=>$ctegories,'tags'=>$tags]);
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
        $post->is_approved = true; 
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        
        $subcribers = Subscriber::all();
//        foreach ($subcribers as $subscriber)
//            {
//            Notification::send('mail',$subscriber->email)
//                    ->notify(new NewPostNotifyToSubscriber($post));
//            }
        
        
        Toastr::success('post added successfully','Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        return view('admin.post.showPost',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts     = Post::find($id);
        $ctegories = Category::all();
        $tags      = Tag::all();
        return view('admin.post.editPost',['post'=>$posts,'categories'=>$ctegories,'tags'=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' =>'required',
            'image' => 'image',
            'categories' =>'required',
            'tags' =>'required',
            'postBody' =>'required'
        ]);
        $post = Post::find($id);
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
        $post->is_approved = true; 
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        
        Toastr::success('post Updated successfully','Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
        $post = Post::find($id);
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
    
    public function pending(){
        $post = Post::where('is_approved',0)->get();
        return view('admin.post.pending',['posts'=>$post]);
    }
    
    public function approval($id){
       $post = Post::find($id);
       if($post->is_approved == false){
           $post->is_approved = true;
           $post->save();
           $post->user->notify(new AuthorPostApprove($post));
           Toastr::success('Post Successfully Approved','Success');
           return redirect()->back();
       }else{
            Toastr::info('This Post is already Approved','Info');
            return redirect()->back();

       }
    }
}
