<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class HomeController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->take(6)->paginate(6);
        return view('welcome',['categories'=>$categories,'posts'=>$posts]);
    }
}
