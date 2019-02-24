@extends('author.authorDashboard')
@section('content')

<h2></h2>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>{{ $post->title}}</h2>
                <small>Posted By <strong><a href="">{{ $post->user->name}}</a></strong> on <span style="color:green;">{{ $post->created_at}}</span></small>
                <!-- toFormattedDateString() use korte hobe date time k readable korar jonno/ -->
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <h4 class="text-center"> Status</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        @if($post->is_approved == false)
                                        <button class="btn btn-warning" ><a href="" style="color: white;text-decoration: none;">Need to Approve</a></button>
                                        @else
                                            <span style="color: green;"> Already Approved</span>
                                        @endif
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <h4 class="text-center"> Categories</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        <ol style="color: #0066cc;">
                                            @foreach($post->categories as $category)
                                            <li> {{ $category->categoryName }} </li>
                                            @endforeach
                                        </ol>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                    <h4 class="text-center"> Tags</h4>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        <ol style="color: #009933;">
                                            @foreach($post->tags as $tag)
                                            <li> {{ $tag->tagName }} </li>
                                            @endforeach
                                        </ol>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h4 class="text-center"> Featured Image</h4>
                            </div>
                            <div class="panel-body">
                                <strong><span class="pull-center">
                                        <image src="{{ Storage::disk('public')->url('post/'.$post->image)}}" height="100px" width="180px">
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <!--//end of row-->
                </div>
                <!--end of panel-body-->
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h3> Post Body</h3>
                            </div>
                            <div class="panel-body">
                                <strong>
                                    {!! $post->body !!}
                                </strong>
                            </div>
                            <div class="panel-footer">
                                <a href="{{ route('author.post.index')}}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
        </div> <!-- /end .row) -->
    </div> <!-- /.panel-body -->
</div><!-- /.panel -->
</div>
@endsection