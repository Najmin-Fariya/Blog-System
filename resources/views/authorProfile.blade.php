@extends('frontEnd.master')
@section('title','Profile')
@push('css')
<style>
    .favourite_posts{
        color: blue;
    }
</style>
@endpush
@section('content')

<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $author->name }}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">
                @if($posts->count() > 0)
                    @foreach($posts as $post) 
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">

                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image)}}" alt="{{ $post->postName }}"></div>

                                <a class="avatar" href="{{ route('author.authorProfile',$post->user->username)}}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="{{ $post->user->name }}"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details',$post->slug)}}"><b>{{ $post->title }}</b></a></h4>

                                    <ul class="post-footer">

                                        <li>
                                            @guest
                                            <a href="javascript:void(0);" onclick="toastr.info('To add favourite list, you need to login first.', 'info', {
                                            closeButton: true,
                                                    progressbar: true,
                                            })"><i class="ion-heart"></i>{{ $post->favourite_to_users->count() }}</a>
                                            @else
                                            <a href="javascript:void(0);" onclick="document.getElementById('favourite-form-{{ $post->id}}').submit();"
                                               class="{{ !Auth::user()->favourite_posts->where('post_id',$post->id)->count() == 0 ?'favourite_posts': '' }}"
                                               >
                                                <i class="ion-heart"></i>{{ $post->favourite_to_users->count() }}</a>
                                            <form action="{{ route('post.favourite',$post->id)}}" id="favourite-form-{{ $post->id}}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            @endguest

                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- card --> 
                        </div><!-- col-lg-4 col-md-6 -->
                    </div><!-- col-lg-4 col-md-6 -->
                    @endforeach  
                 @else
                    <div class="col-lg-12 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-info">

                                    <h4 class="title" style="color:red;font-weight: bold;">Sorry Author doesn't have any post.  :( </h4>

                                </div><!-- blog-info -->
                            </div><!-- card --> 
                        </div><!-- col-lg-4 col-md-6 -->
                    </div><!-- col-lg-4 col-md-6 -->
                 @endif
                </div><!-- row -->

                
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 ">

                <div class="single-post info-area">

                    <div class="about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        <p>{{ $author->name}}</p><br>
                        <p>{!! $author->about !!}</p><br>
                        <strong>Author Since:{{ $author->created_at->toDateString()}}</strong><br>
                        <strong>Total Posts:{{ $author->posts()->approved()->published()->count()}}</strong>
                    </div>
                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->

@endsection