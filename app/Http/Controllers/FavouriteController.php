<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class FavouriteController extends Controller
{
    public function add($post){
//        return $post;
        $user = Auth::user();
        $isFavourite = $user->favourite_posts()->where('post_id',$post)->count();
        if($isFavourite == 0){
            $user->favourite_posts()->attach($post);
            Toastr::success('Post Successfully added to your favourite list','success');
            return redirect()->back();
        }else{
            $user->favourite_posts()->detach($post);
            Toastr::warning('Post removed from your favourite list','warning');
            return redirect()->back();
        }
    }
}
