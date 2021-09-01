<li>
    <div class="nav-label text-white p-3 mt-2">Menu {{auth()->user()->role}}</div>
</li>
@if(Auth::user()->role == "Admin")
{{--    <li class="{{ (request()->is('master-jurnal*') ) ? 'active' : '' }} nav-first-level">--}}
{{--        <a href="#"><i class="fa fa-bookmark"></i> <span class="nav-label">Data Jurnal</span> <span class="fa arrow"></span></a>--}}
{{--    </li>--}}
    <li class="{{ request()->is('user*') ? 'active' : '' }}">
        <a href="{{ route('user.index')}}"><i class="fa fa-user"></i> <span class="nav-label">User</span></a>
    </li>
@endif

