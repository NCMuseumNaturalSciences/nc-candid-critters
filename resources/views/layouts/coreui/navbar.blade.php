<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a id="brand" class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown d-md-down-none">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->fname }} {{ Auth::user()->lname }}
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg" aria-labelledby="navbarDropdown">
                <a href="{{ url('/logout') }}" class="dropdown-item"><i class="icon-user-follow text-success"></i> Logout</a>
            </div>
        </li>
    </ul>
</header>
<style>
    .app-header.navbar {
        padding-right: 40px;
    }
    ul.navbar-nav li.nav-item {
        margin-right: 20px;
    }
</style>