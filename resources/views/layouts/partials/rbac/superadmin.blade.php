@php
    $roles = Auth::user()
        ->getRoleNames()
        ->toArray();
@endphp

<li
    class="has-sub {{ \Request::is(app()->getLocale() . '/admin/extra-authors*') || \Request::is(app()->getLocale() . '/admin/depositories*') || \Request::is(app()->getLocale() . '/admin/book-acts*') || \Request::is(app()->getLocale() . '/admin/book*') || \Request::is(app()->getLocale() . '/admin/subjects*') || \Request::is(app()->getLocale() . '/admin/whos*') || \Request::is(app()->getLocale() . '/admin/wheres*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-bookshelf"></i>
        <span class="nav-text">{{ __('Books') }}</span> <b class="caret"></b>
    </a>
    <div
        class="collapse {{ \Request::is(app()->getLocale() . '/admin/extra-authors*') || \Request::is(app()->getLocale() . '/admin/depositories*') || \Request::is(app()->getLocale() . '/admin/book-acts*') || \Request::is(app()->getLocale() . '/admin/book*') || \Request::is(app()->getLocale() . '/admin/subjects*') || \Request::is(app()->getLocale() . '/admin/whos*') || \Request::is(app()->getLocale() . '/admin/wheres*') ? 'show' : '' }}">
        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Books Type') }}</span>
                </a>
            </li>

            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-languages*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-languages') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Language') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-texts*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-texts') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Text') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-text-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-text-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Text Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-file-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-file-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book File Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-subjects*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-subjects') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Subject') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/subject*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/subjects') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Subjects') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-access-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-access-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Access Type') }}</span>
                </a>
            </li>

            <li class="{{ \Request::is(app()->getLocale() . '/admin/who*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/whos') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Who') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/where*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/wheres') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Where') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/extra-authors*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/extra-authors') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Extra Author') }}</span>
                </a>
            </li>


            <li class="{{ \Request::is(app()->getLocale() . '/admin/books*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/books') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Books') }}</span>
                </a>
            </li>

            <li class="{{ \Request::is(app()->getLocale() . '/admin/books/inventar*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/books/inventar') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Inventar Numbers') }}</span>
                </a>
            </li>

            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-acts*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-acts') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Act') }}</span>
                </a>
            </li>

            <li class="{{ \Request::is(app()->getLocale() . '/admin/depositories*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/depositories') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Depository') }}</span>
                </a>
            </li>

        </ul>
    </div>
</li>






<li class="has-sub {{ \Request::is(app()->getLocale() . '/admin/res*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-bookmark-box-multiple"></i>
        <span class="nav-text">{{ __('Scientific publications') }}</span> <b class="caret"></b>
    </a>
    <div class="collapse {{ \Request::is(app()->getLocale() . '/admin/res*') ? 'show' : '' }}">
        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/res-lang*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/res-lang') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Resource language') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/res-type*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/res-type') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Resource Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/res-field*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/res-field') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Resource Field') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/res-dissertations*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/res-dissertations') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Dissertations') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/res-abstracts*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/res-abstracts') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Abstracts') }}</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="has-sub {{ \Request::is(app()->getLocale() . '/admin/socials*') ? 'active expand' : ''  || \Request::is(app()->getLocale() . '/admin/contacts*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-play-protected-content"></i>
        <span class="nav-text">{{ __('Content') }}</span> <b class="caret"></b>
    </a>
    <div class="collapse {{ \Request::is(app()->getLocale() . '/admin/socials*') ? 'show' : '' || \Request::is(app()->getLocale() . '/admin/contacts*') ? ' show ' : ''  }}">
        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/contacts*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/contacts') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Contact') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/socials*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/socials') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Social') }}</span>
                </a>
            </li>

        </ul>
    </div>
</li>



<li
    class="has-sub {{ \Request::is(app()->getLocale() . '/admin/journals*') || \Request::is(app()->getLocale() . '/admin/magazine-issues*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-bookmark-box-multiple"></i>
        <span class="nav-text">{{ __('Periodicals') }}</span> <b class="caret"></b>
    </a> 
    <div
        class="collapse {{ \Request::is(app()->getLocale() . '/admin/journal-articles*') || \Request::is(app()->getLocale() . '/admin/journals*') || \Request::is(app()->getLocale() . '/admin/magazine-issues*') ? 'show' : '' }}">
        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/journals*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/journals') }}" class="sidenav-item-link ">
                    <i class="mdi mdi-comment-text-outline"></i>
                    <span class="nav-text">{{ __('Journal') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/magazine-issues*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/magazine-issues') }}" class="sidenav-item-link ">
                    <i class="mdi mdi-newspaper"></i>
                    <span class="nav-text">{{ __('Magazine Issue') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/journal-articles*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/journal-articles') }}" class="sidenav-item-link ">
                    <i class="mdi mdi-newspaper"></i>
                    <span class="nav-text">{{ __('Journal Articles') }}</span>
                </a>
            </li>

        </ul>
    </div>
</li>



{{-- <li class="{{ \Request::is(app()->getLocale() . '/admin/articles*') ? 'active' : '' }}">
							<a href="{{ url(app()->getLocale() . '/admin/articles') }}"
								class="sidenav-item-link ">
								<i class="mdi mdi-newspaper"></i>
								<span class="nav-text">{{ __('Articles') }}</span>
							</a>
						</li> --}}

<!-- Users -->
<li
    class="has-sub {{ \Request::is(app()->getLocale() . '/admin/reference-genders*') || \Request::is(app()->getLocale() . '/admin/permiss*') || \Request::is(app()->getLocale() . '/admin/role*') || \Request::is(app()->getLocale() . '/admin/user-types*') || \Request::is(app()->getLocale() . '/admin/roles*') || \Request::is(app()->getLocale() . '/admin/user*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-account-group"></i>
        <span class="nav-text">{{ __('Users') }}</span> <b class="caret"></b>
    </a>
    <div
        class="collapse {{ \Request::is(app()->getLocale() . '/admin/reference-genders*') || \Request::is(app()->getLocale() . '/admin/permiss*') || \Request::is(app()->getLocale() . '/admin/roles*') || \Request::is(app()->getLocale() . '/admin/user*') ? 'show' : '' }}">
        <ul class="sub-menu" id="users" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/reference-genders*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/reference-genders') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Reference Gender') }}</span>
                </a>
            </li>
            @if (in_array('SuperAdmin', $roles))
                <li class="{{ \Request::is(app()->getLocale() . '/admin/user-types*') ? 'active' : '' }}">
                    <a href="{{ url(app()->getLocale() . '/admin/user-types') }}" class="sidenav-item-link ">
                        <span class="nav-text">{{ __('User Type') }}</span>
                    </a>
                </li>
                <li class="{{ \Request::is(app()->getLocale() . '/admin/roles*') ? 'active' : '' }}">
                    <a href="{{ url(app()->getLocale() . '/admin/roles') }}" class="sidenav-item-link ">
                        <span class="nav-text">{{ __('Roles') }}</span>
                    </a>
                </li>
                <li class="{{ \Request::is(app()->getLocale() . '/admin/permissions*') ? 'active' : '' }}">
                    <a href="{{ url(app()->getLocale() . '/admin/permissions') }}" class="sidenav-item-link ">
                        <span class="nav-text">{{ __('Permissions') }}</span>
                    </a>
                </li>
            @endif
            <li class="{{ \Request::is(app()->getLocale() . '/admin/users*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/users') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('User list') }}</span>
                </a>
            </li>
        </ul>
    </div>
</li>

{{-- Statistics --}}
<li
    class="has-sub {{ \Request::is(app()->getLocale() . '/admin/employeestat*') ||  \Request::is(app()->getLocale() . '/admin/statbookwhos*') || \Request::is(app()->getLocale() . '/admin/subjects*') || \Request::is(app()->getLocale() . '/admin/statbooktexts*') || \Request::is(app()->getLocale() . '/admin/statbooklangs*') || \Request::is(app()->getLocale() . '/admin/statdebtors*') || \Request::is(app()->getLocale() . '/admin/statbooks*') || \Request::is(app()->getLocale() . '/admin/statbooktypes*') || \Request::is(app()->getLocale() . '/admin/statdebtorsbooktypes*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-chart-timeline"></i>
        <span class="nav-text">{{ __('Statistics') }}</span> <b class="caret"></b>
    </a>
    <div     
        class="collapse {{ \Request::is(app()->getLocale() . '/admin/employeestat*') || \Request::is(app()->getLocale() . '/admin/statbookwhos*') || \Request::is(app()->getLocale() . '/admin/subjects*') || \Request::is(app()->getLocale() . '/admin/statbooktexts*') || \Request::is(app()->getLocale() . '/admin/statbooklangs*') || \Request::is(app()->getLocale() . '/admin/statdebtors*') || \Request::is(app()->getLocale() . '/admin/statbooks*') || \Request::is(app()->getLocale() . '/admin/statbooktypes*') || \Request::is(app()->getLocale() . '/admin/statdebtorsbooktypes*') ? 'show' : '' }}">
        <ul class="sub-menu" id="users" data-parent="#sidebar-menu">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/employeestat*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/employeestat') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Employee statistics') }}</span>
                </a>
            </li>
            <hr style="background-color: #343a40;">

            <li class="{{ \Request::is(app()->getLocale() . '/admin/statdebtors*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statdebtors') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Debtors') }}</span>
                </a>
            </li>


            <li class="{{ \Request::is(app()->getLocale() . '/admin/statdebtorsbooktypes*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statdebtorsbooktypes') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Debtors type') }}</span>
                </a>
            </li>
            <hr style="background-color: #343a40;">
            <li class="{{ \Request::is(app()->getLocale() . '/admin/statbooks*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statbooks') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Books') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/statbooktypes*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statbooktypes') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Books Type') }}</span>
                </a>
            </li>


            <li class="{{ \Request::is(app()->getLocale() . '/admin/statbooklangs*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statbooklangs') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Language') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/statbooktexts*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statbooktexts') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Text') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/statbooksubjects*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statbooksubjects') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Subjects') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/statbookwhos*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/statbookwhos') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Who') }}</span>
                </a>
            </li>

            {{-- <li class="{{ \Request::is(app()->getLocale() . '/admin/users*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/users') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('User list') }}</span>
                </a>
            </li> 
             --}}
        </ul>
    </div>
</li>




<li class="{{ \Request::is(app()->getLocale() . '/admin/imports*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/imports') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('Import') }}</span>
    </a>
</li>

@if (in_array('SuperAdmin', $roles))
    <li class="{{ \Request::is(app()->getLocale() . '/admin/organizations*') ? 'active' : '' }}">
        <a href="{{ url(app()->getLocale() . '/admin/organizations') }}" class="sidenav-item-link ">
            <i class="mdi mdi-city"> </i>
            <span class="nav-text">{{ __('Organization') }}</span>
        </a>
    </li>
@endif
<li class="{{ \Request::is(app()->getLocale() . '/admin/branches*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/branches') }}" class="sidenav-item-link ">
        <i class="mdi mdi-office-building"> </i>
        <span class="nav-text">{{ __('Branch') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/departments*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/departments') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Department') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/faculties*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/faculties') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Faculties') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/chairs*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/chairs') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Chairs') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/groups*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/groups') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Groups') }}</span>
    </a>
</li>
{{-- 
<li class="{{ \Request::is(app()->getLocale() . '/admin/udcs*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/udcs') }}" class="sidenav-item-link ">
        <i class="mdi mdi-format-list-numbered"></i>
        <span class="nav-text">{{ __('Udc') }}</span>
    </a>
</li>


<li class="{{ \Request::is(app()->getLocale() . '/admin/authors*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/authors') }}" class="sidenav-item-link ">
        <i class="mdi mdi-account-box-multiple"></i>
        <span class="nav-text">{{ __('Author') }}</span>
    </a>
</li> --}}

<li class="{{ \Request::is(app()->getLocale() . '/admin/take-give*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/take-give') }}" class="sidenav-item-link ">
        <i class="mdi mdi-barcode-scan"></i>
        <span class="nav-text">{{ __('Takegive') }}</span>
    </a>
</li>


<li class="{{ \Request::is(app()->getLocale() . '/admin/debtors*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/debtors') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('Debtors') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/orders*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/orders') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('Orders') }}</span>
    </a>
</li>
