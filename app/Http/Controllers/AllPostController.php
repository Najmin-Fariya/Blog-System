<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class AllPostController extends Controller
{
    public function allPosts(){
         $post = Post::latest()->approved()->published()->get();
       return view('frontEnd.allPost',['posts'=> $post]);
    }
    
    public function postsByCategory($slug){
       $category = Category::where('slug',$slug)->first(); 
       return view('frontEnd.category',['category'=>$category]);
    }
    
    public function postsByTag($slug){
       $tag = Tag::where('slug',$slug)->first(); 
       return view('frontEnd.tag',['tag'=>$tag]);
    }
}
