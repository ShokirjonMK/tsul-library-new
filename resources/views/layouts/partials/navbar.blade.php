<header class="ec-main-header" id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle"></button>

        <!-- search form -->
        <div class="search-form d-lg-inline-block">
            {{-- <div class="input-group">
                <input type="text" name="query" id="search-input" class="form-control" placeholder="search.." autofocus
                    autocomplete="off" />
                <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i>
                </button>
            </div>
            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div> --}}
        </div>

        <!-- navbar right -->
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                @php
                    $carts = session()->get('cart', []);
                @endphp
                @if (count($carts)>0)
                    <li class=" right-sidebar-2-menu">
                        <a href="{{ url(app()->getLocale() . '/admin/cart') }}"><i class="mdi mdi-cart"></i>
                        <span class="badge badge-success navbar-badge">{{count($carts)}}</span>
                        </a>
                    </li>
                @endif
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown" aria-expanded="false">
						@if (Auth::user()->profile != null && Auth::user()->profile->image)
						<img src="/storage/{{ Auth::user()->profile->image }}" class="img-image"
                                    alt="{{ Auth::user()->name }}" width="40" />
						@else
							<img src="/assets/img/user/user.png" class="user-image" alt="{{ Auth::user()->name }}" />

						@endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
                        <!-- User image -->
                        <li class="dropdown-header">
                            @if (Auth::user()->profile != null && Auth::user()->profile->image)
                                <img src="/storage/{{ Auth::user()->profile->image }}" class="img-circle"
                                    alt="{{ Auth::user()->name }}" />
                            @else
                                <img src="/assets/img/user/user.png" class="img-circle"
                                    alt="{{ Auth::user()->name }}" />
                            @endif
                            <div class="d-inline-block">
                                {{ Auth::user()->name }}
                                <small class="pt-1">{{ Auth::user()->email }}
                                </small>
                            </div>
                        </li>
                        <li>
                            <a href="{{ url(app()->getLocale() . '/admin/my') }}"> 
                                <i class="mdi mdi-account"></i> {{ __('My Profile') }}
                            </a>
                        </li> 
                        <li class="dropdown-footer">
                            <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout"></i> {{ __('Log Out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>


                    </ul>
                </li>
{{--                 
                <li class="right-sidebar-in right-sidebar-2-menu">
								<i class="mdi mdi-settings-outline mdi-spin"></i>
				</li>  --}}
            </ul>
        </div>
    </nav>
</header>
