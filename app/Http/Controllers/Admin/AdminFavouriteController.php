<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminFavouriteController extends Controller
{
    public function index(){
        $favouritePosts = Auth::user()->favourite_posts;
        return view('admin.showFavourites',['favouritePosts'=>$favouritePosts]);
    }
}
