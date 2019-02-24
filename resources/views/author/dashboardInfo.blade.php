@extends('author.authorDashboard')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-th-list fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$posts->count() }}</div>
                        <div>Total Posts</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-th-list fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $total_pending_posts->count() }}</div>
                        <div>Pending Posts</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-heart fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ Auth::user()->favourite_posts->count() }}</div>
                        <div>Total Favourite Posts</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-eye-open fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $all_views }}</div>
                        <div>Total View</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="color: blue;background-color: greenyellow;">TOP 5 POPULAR POSTS</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Rank List</th>
                                <th>Title</th>
                                <th>Views</th>
                                <th>Favourits</th>
                                <th>Comments</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($popular_posts as $key=>$post)
                            <tr class="odd gradeX">
                                <td>{{ $key + 1}}</td>
                                <td>{{ str_limit($post->title,30)}}</td>
                                <td>{{ $post->view_count }}</td>
                                <td>{{ $post->favourite_to_users_count }}</td>
                                <td>{{ $post->comments_count }}</td>
                                <td>
                                    @if($post->status ==true)
                                    <span style="background-color: green;color: white;"> Published</span>
                                    @else
                                    <span style="background-color: red;color: white;"> Pending </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

@endsection