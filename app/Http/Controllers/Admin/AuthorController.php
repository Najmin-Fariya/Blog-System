<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    public function index(){
            $authors = User::authors()
                ->withCount('posts')
                ->withCount('comments')
                ->withCount('favourite_posts')
                ->get();
    return view('admin.authors', compact('authors'));
    }
    public function destroy($id){
        $author = User::findOrFail($id)->delete();
        Toastr::success('Author successfully deleted','Success');
        return redirect()->back();
    }
}
