<div id="sidebar" class="sidebar menu">
    <div class="sidebar-overlay">
    <div id="menu-wrapper" class="widget">
        <ul id="nav">
            <li>
                <a href="#">Signup Forms <i class="caret-icon fa fa-caret-down"></i></a>
                <ul class="subnav">
                    <li><a class="hvr-underline-from-left" href="{{ url('forms/1/signup') }}">Nonuploader Borrower</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('forms/2/signup') }}">Nonuploader BYO</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('forms/3/signup') }}">Uploader Borrower</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('forms/4/signup') }}">Uploader BYO</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Site Description Forms <i class="fa fa-caret-down"></i></a>
                <ul class="subnav">
                    <li><a class="hvr-underline-from-left" href="{{ url('forms/1/site-description') }}">Nonuploader</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('forms/2/site-description') }}">Uploader</a></li>
                </ul>
            </li>

            <li>
                <a href="#">Maps <i class="fa fa-caret-down"></i></a>
                <ul class="subnav">
                    <li><a class="hvr-underline-from-left" href="{{ url('map/selection') }}">Site Selection</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('map/libraries') }}">Libraries</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Authentication <i class="fa fa-caret-down"></i></a>
                <ul class="subnav">
                    @if (Auth::guest())
                        <li><a class="hvr-underline-from-left" href="{{ url('login') }}">Login</a></li>
                        <li><a class="hvr-underline-from-left" href="{{ url('register') }}">Register</a></li>
                    @else
                        <li><a class="hvr-underline-from-left" href="{{ url('/logout') }}">Logout</a></li>
                    @endif
                </ul>
            </li>
            @role('administrator')
            <li>
                <a href="#">API <i class="fa fa-caret-down"></i></a>
                <ul class="subnav">
                    <li><a class="hvr-underline-from-left" href="{{ url('api/v1/geojson/sites/available') }}">Available Sites</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('api/v1/geojson/sites/all') }}">All Sites</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('api/v1/cameras') }}">Cameras</a></li>
                    <li><a class="hvr-underline-from-left" href="{{ url('api/v1/libraries') }}">Libraries</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Admin <i class="fa fa-caret-down"></i></a>
                <ul class="subnav">
                    <li><a class="hvr-underline-from-left" href="{{ url('admin/dashboard') }}">Administrator Dashboard</a></li>
                </ul>
            </li>
            @endrole
            <li><a href="#" class="hvr-underline-from-left">NC Candid Critters Home</a></li>
        </ul>
    </div>
    </div>
</div>
