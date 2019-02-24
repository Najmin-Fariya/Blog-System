<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{ route('home')}}" class="logo" style="color: #ff6600;"><b>PROGRAMMING&TECH</b></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ route('view.allPost')}}">Posts</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="{{ route('register')}}">Register</a></li>
            <li><a href="{{ route('login')}}">Login</a></li>
        </ul><!-- main-menu -->

        <div class="src-area">
            <form action="{{ route('search')}}" method="GET">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input name="query" value="{{ isset($query) ? $query : ''}}" class="src-input" type="text" placeholder="Type of search">
            </form>
        </div>

    </div><!-- conatiner -->
</header>