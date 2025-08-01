
<li class="{{ \Request::is(app()->getLocale() . '/admin/dreader*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/dreader') }}"
        class="sidenav-item-link ">
        <i class="mdi mdi-comment-text-outline"></i>
        <span class="nav-text">{{ __('Scientific publications') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/reader*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/reader') }}"
        class="sidenav-item-link ">
        <i class="mdi mdi-comment-text-outline"></i>
        <span class="nav-text">{{ __('My debts') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/breader*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/breader') }}"
        class="sidenav-item-link ">
        <i class="mdi mdi-bookshelf"></i>
        <span class="nav-text">{{ __('Order books') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/myorders*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/myorders') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('My Orders') }}</span>
    </a>
</li>
