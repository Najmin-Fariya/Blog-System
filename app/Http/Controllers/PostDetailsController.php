<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Session;

class PostDetailsController extends Controller
{
    public function details($slug){
        $post = Post::where('slug',$slug)->first();
        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $randomPosts = Post::all()->random(3);
        return view('frontEnd.postDetails', compact('post','randomPosts'));
        
    }
}
