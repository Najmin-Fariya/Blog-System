<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;

class AdminCommentController extends Controller
{
    public function viewComment(){
        $comments = Comment::latest()->get();
        return view('admin.comment.viewComment',['comments'=>$comments]);
    }
    
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Toastr::warning('Comment Successfully Deleted','warning');
        return redirect()->back();
    }
}
