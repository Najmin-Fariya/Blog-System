<?php

namespace App\Http\Controllers\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class AuthorCommentsController extends Controller
{
     public function viewComment(){
        $posts = Auth::user()->posts;
        return view('author.comment.viewComment',['posts'=>$posts]);
    }
    
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        if( $comment->post->user->id == Auth::id()){
        $comment->delete();
        Toastr::warning('Comment Successfully Deleted','warning'); 
        } else {
        Toastr::error('You are unauthorized to delete this comment','error'); 
        }
        
        return redirect()->back();
    }
}
