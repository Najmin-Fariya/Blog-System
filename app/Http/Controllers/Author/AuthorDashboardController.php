<?php

namespace App\Http\Controllers\Author;

use App\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
                ->withCount('comments')
                ->withCount('favourite_to_users')
                ->orderBy('view_count','desc')
                ->orderBy('comments_count')
                ->orderBy('favourite_to_users_count')
                ->take(5)->get();
        $total_pending_posts = $posts->where('is_approved',false);
        $all_views = $posts->sum('view_count');
        return view('author.dashboardInfo', 
                compact('posts','popular_posts','total_pending_posts','all_views'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
