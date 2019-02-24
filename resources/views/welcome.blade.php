@extends('frontEnd.master')
@section('title')
    Blog
@endsection
@push('css')
    <style>
        .favourite_posts{
            color: blue;
        }
    </style>
@endpush
@section('content')

    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                
                    <div class="swiper-slide">
                    <a class="slider-category" href="{{ route('category.posts',$category->slug) }}">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('category/slider/'.$category->image)}}" alt="{{ $category->categoryName }}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{ $category->categoryName }}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->

                @endforeach
            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
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
                                        <a href="javascript:void(0);" onclick="toastr.info('To add favourite list, you need to login first.','info',{
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
            </div><!-- row -->

            {{ $posts->links() }}

        </div><!-- container -->
    </section><!-- section -->

@endsection