
<li class="{{ \Request::is(app()->getLocale() . '/admin/where*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/wheres') }}" class="sidenav-item-link ">
        <i class="mdi mdi-office-building-marker"></i>
        <span class="nav-text">{{ __('Where') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/publishers*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/publishers') }}" class="sidenav-item-link ">
        <i class="mdi mdi-office-building-marker-outline"></i>
        <span class="nav-text">{{ __('From whom or where it came from') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/basics*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/basics') }}" class="sidenav-item-link ">
        <i class="mdi mdi-archive-outline"></i>
        <span class="nav-text">{{ __('Basics') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/gen-types*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/gen-types') }}" class="sidenav-item-link ">
        <i class="mdi mdi-arrange-send-backward"></i>
        <span class="nav-text">{{ __('Gen Types') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/documents*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/documents') }}" class="sidenav-item-link ">
        <i class="mdi mdi-newspaper"></i>
        <span class="nav-text">{{ __('Documents') }}</span>
    </a>
</li>


{{-- <li
    class="has-sub {{ \Request::is(app()->getLocale() . '/admin/statistics-by-month*') ||  \Request::is(app()->getLocale() . '/admin/statbookwhos*') || \Request::is(app()->getLocale() . '/admin/subjects*') || \Request::is(app()->getLocale() . '/admin/statbooktexts*') || \Request::is(app()->getLocale() . '/admin/statbooklangs*') || \Request::is(app()->getLocale() . '/admin/statdebtors*') || \Request::is(app()->getLocale() . '/admin/statbooks*') || \Request::is(app()->getLocale() . '/admin/statbooktypes*') || \Request::is(app()->getLocale() . '/admin/statdebtorsbooktypes*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-chart-timeline"></i>
        <span class="nav-text">{{ __('Statistics') }}</span> <b class="caret"></b>
    </a>
    <div     
        class="collapse {{ \Request::is(app()->getLocale() . '/admin/statistics-by-month*') || \Request::is(app()->getLocale() . '/admin/statbookwhos*') || \Request::is(app()->getLocale() . '/admin/subjects*') || \Request::is(app()->getLocale() . '/admin/statbooktexts*') || \Request::is(app()->getLocale() . '/admin/statbooklangs*') || \Request::is(app()->getLocale() . '/admin/statdebtors*') || \Request::is(app()->getLocale() . '/admin/statbooks*') || \Request::is(app()->getLocale() . '/admin/statbooktypes*') || \Request::is(app()->getLocale() . '/admin/statdebtorsbooktypes*') ? 'show' : '' }}">
        <ul class="sub-menu" id="users" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/statistics-by-month*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statistics-by-month') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Statistics by month') }}</span>
                </a>
            </li>
            <hr style="background-color: #343a40;">
 
        </ul>
    </div>
</li> --}}
