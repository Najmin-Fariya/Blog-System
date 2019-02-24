@extends('author.authorDashboard')
@section('content')

<h2></h2>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Posts
            </div>
            <form action="{{ route('author.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
            <div class="panel-body">
                <div class="row">
                    
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input id="title" class="form-control" type="text"  name="title" value="{{ $post->title }}">
                                <span class="text-danger">{{$errors->has('title')?$errors->first('title'):''}}</span>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input class="form-control" type="file" name="image">
                                <span class="text-danger">{{$errors->has('image')?$errors->first('image'):''}}</span>

                            </div>
                            <div class="form-group">
                                <input id="publish" type="checkbox" name="status" value="1" {{ $post->status == 1? 'checked' : ' ' }}>
                                <label for="publish">Publish</label>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                    <textarea class="form-control" name="postBody" rows="5">{{ $post->body }} </textarea>
                                    <span class="text-danger">{{$errors->has('postBody')?$errors->first('postBody'):''}}</span>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-4">
                            <h3 style="color: blue;">Select Tags & Categories</h3>
                            <div class="form-group">
                                <label>Categories</label>
                                <select class="form-control" name="categories[]" id="categories">
                                    @foreach($categories as $category)
                                    <option 
                                        @foreach($post->categories as $postCategories)
                                            {{ $postCategories->id == $category->id? 'selected': ''}}
                                        @endforeach
                                        value="{{ $category->id }}" >{{ $category->categoryName }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->has('categories[]')?$errors->first('categories[]'):''}}</span>
                            </div>
                            <div class="form-group" >
                                <label>Tags</label>
                                <select class="form-control" name="tags[]" id="tags">
                                    @foreach($tags as $tag)
                                    <option 
                                        @foreach($post->tags as $postTags)
                                            {{ $postTags->id == $tag->id? 'selected': ''}}
                                        @endforeach
                                        value="{{ $tag->id }}">{{ $tag->tagName }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->has('tags[]')?$errors->first('tags[]'):''}}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a  href="{{route ('author.post.index')}}"class="btn btn-danger">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                </div> <!-- /end .row) -->
            </div> <!-- /.panel-body -->
        </form>
        </div><!-- /.panel -->
    </div><!-- / col -12 -->
</div><!-- /end first .row) -->




       

@endsection