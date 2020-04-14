<div class="sidebar" id="sidebar">
    <nav class="sidebar-nav" id="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}"><i class="icon-home"></i> Home</a>
            </li>

            @role('librarian')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('librarian/profile') }}"><i class="fas fa-book-reader"></i> Profile</a>
                <a class="nav-link" href="{{ url('librarian/reservations') }}"><i class="fas fa-book"></i> Reservations</a>
            </li>
            @endrole

            @role('administrator')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('profile') }}"><i class="fas fa-user-circle"></i> Profile</a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="far fa-file-alt"></i> Submissions</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">Signups</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin/signups') }}"><i class="fas fa-list-ol"></i> All</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">Site Descriptions</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
<!--                                <a class="nav-link" href="{{ url('admin/site-descriptions') }}"><i class="fas fa-list-ol"></i> All</a> -->
                                <a class="nav-link" href="{{ url('admin/site-descriptions/uploaders') }}"><i class="fas fa-upload"></i> Uploaders</a>
                                <a class="nav-link" href="{{ url('admin/site-descriptions/nonuploaders') }}"><i class="fas fa-download"></i> Non-uploaders</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/map-selections') }}">Selected Map Sites</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-user-alt"></i> Volunteers</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/volunteers') }}"><i class="fas fa-list-ol"></i> All</a>
                        <a class="nav-link" href="{{ url('/admin/volunteers/rewards') }}">Rewards</a>
                        <a class="nav-link" href="{{ url('/admin/libraries-volunteers') }}">Library Assignments</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fab fa-font-awesome-flag"></i> Deployments</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/deployments') }}"><i class="fas fa-list-ol"></i> All</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-university"></i> Libraries</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/libraries/create') }}"><i class="fas fa-plus"></i> Create New</a>
                        <a class="nav-link" href="{{ url('/admin/libraries') }}"><i class="fas fa-list-ol"></i> All</a>
                        <a class="nav-link" href="{{ url('/admin/libraries-volunteers') }}">Volunteer Assignments</a>
                        <a class="nav-link" href="{{ url('/admin/libraries-users') }}">Library Accounts</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-user-alt"></i> Reservations</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/reservations/create') }}"><i class="fas fa-plus"></i> Create New</a>
                        <a class="nav-link" href="{{ url('/admin/reservations/all') }}"><i class="fas fa-list-ol"></i> All</a>
                        <a class="nav-link" href="{{ url('/admin/reservations/open') }}">Open</a>
                        <a class="nav-link" href="{{ url('/admin/reservations/closed') }}">Closed</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="far fa-file-alt"></i> Auxiliary</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/exports') }}"><ion-icon name="document"></ion-icon> Data Export Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/apis') }}">API Information</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fab fa-font-awesome-flag"></i> Master Lists</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-camera-retro"></i> Cameras</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/cameras') }}"><i class="fas fa-list-ol"></i> All</a>
                                <a class="nav-link" href="{{ url('/admin/cameras/create') }}"><i class="fas fa-plus"></i> Add New</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-map-marker"></i> Map Sites</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/map-sites') }}"><i class="fas fa-list-ol"></i> All</a>
                                <a class="nav-link" href="{{ url('/admin/map-sites/create') }}"><i class="fas fa-plus"></i> Create New</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="{{ url('/admin/inventories') }}"><i class="fa fa-wrench"></i> Inventories</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-user-lock"></i> Administration</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/users') }}"><ion-icon name="contact"></ion-icon> All Users</a>
                        <a class="nav-link" href="{{ url('/admin/libraries-users') }}"><ion-icon name="document"></ion-icon> Library User Accounts</a>
                        <a class="nav-link" href="{{ url('/admin/roles') }}"><ion-icon name="contact"></ion-icon> All Roles</a>
                        <a class="nav-link" href="{{ url('/admin/permissions') }}"><ion-icon name="contact"></ion-icon> All Permissions</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}"><i class="icon-speedometer"></i> Frontend Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
            </li>
        @endrole
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>