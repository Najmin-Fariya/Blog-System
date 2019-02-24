<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorFavouriteController extends Controller
{
    public function index(){
        $favouritePosts = Auth::user()->favourite_posts;
        return view('author.authorShowFavourites',['favouritePosts'=>$favouritePosts]);
    }
}
