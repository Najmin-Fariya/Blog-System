<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>

        @if(Request::is('admin*'))
            <li>
                <a href="{{ route('admin.dashboard') }}"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}"><i class="glyphicon glyphicon-list"></i> Category</a>
            </li>
            <li>
                <a href="{{ route('admin.tag.index') }}"><i class="glyphicon glyphicon-tags"></i> Tag</a>
            </li>
            
            <li>
                <a href="{{ route('admin.post.index') }}"><i class="glyphicon glyphicon-edit"></i> Posts</a>
            </li>
            <li class="{{Request::is('admin/pending/post')?'active':'' }}">
                <a href="{{ route('admin.post.pending') }}"><i class="glyphicon glyphicon-edit"></i> Pending Posts</a>
            </li>
            
            <li>
                <a href="{{ route('admin.authors.index') }}"><i class="glyphicon glyphicon-user"></i> Authors</a>
            </li>
            
            <li class="{{Request::is('admin/subscriber')?'active':'' }}">
                <a href="{{ route('admin.subscriber.index') }}"><i class="glyphicon glyphicon-user"></i> Subscribers</a>
            </li>
            <li>
                <a href="{{ route('admin.favourite.index') }}"><i class="glyphicon glyphicon-heart"></i> Favourites </a>
            </li>
            <li>
            <a href="{{ route('admin.comment.viewComment') }}"><i class="glyphicon glyphicon-comment"></i> Comments </a>
            </li>

        @endif
        
        @if(Request::is('author*'))
            <li>
                <a href="{{ route('author.dashboard') }}"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('author.post.index') }}"><i class="glyphicon glyphicon-edit"></i> Posts</a>
            </li>
            <li>
                <a href="{{ route('author.favourite.index') }}"><i class="glyphicon glyphicon-heart"></i> Favourites </a>
            </li>
            <li>
            <a href="{{ route('author.comment.viewComment') }}"><i class="glyphicon glyphicon-comment"></i> Comments </a>
            </li>
           
        @endif
        <li><a href="{{ Auth::user()->role->id == 1? route('admin.settings') : route('author.authorSettings')}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
 </ul>

    </div>
    <!-- /.sidebar-collapse -->
</div>