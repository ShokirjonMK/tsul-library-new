<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home', app()->getLocale()) }}" class="brand-link" title="AKBT">
        <span class="brand-text font-weight-light">AKBT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                @if (Auth::user()->profile != null && Auth::user()->profile->image)
                <img src="/storage/{{ Auth::user()->profile->image }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}" width="40" />
                @else
                    <img src="/assets/img/user/user.png" class="img-circle elevation-2" alt="{{ Auth::user()->name }}" />
                @endif
            </div>
            <div class="info" style="color: #fff;">
                <a href="{{ url(app()->getLocale() . '/admin/my') }}" class="d-block">{{ Auth::user()->name }}</a>
                <small class="pt-1">{{ Auth::user()->email }}
                </small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Dashboard -->
                        
						<li class="nav-item {{ \Request::is(app()->getLocale() . '/admin/home*') ? 'active' : ''  ||  \Request::is(app()->getLocale() . '/home*') ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.home', app()->getLocale()) }}">
								<i class="mdi mdi-view-dashboard-outline"></i>
								<span class="nav-text">{{ __('Dashboard') }}</span>
							</a>
						</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout"></i> {{ __('Log Out') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
