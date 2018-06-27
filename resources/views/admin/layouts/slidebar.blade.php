<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">
                <a href="#" class="waves-effect"><img src="{{ asset('uploads/admins-avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar) }}" alt="user-img" class="img-circle"> <span class="hide-menu">{{ \Illuminate\Support\Facades\Auth::user()->f_name }} {{ \Illuminate\Support\Facades\Auth::user()->l_name }}<span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('admin.profile') }}"><i class="ti-user"></i> Trang cá nhân</a></li>
                    <li><a href="{{ route('manga.logout') }}"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
                </ul>
            </li>
            @can('read-admins')
            <li><a href="{{ route('admins.index') }}" class="waves-effect"><i class="icon-user mr-3"></i><span class="hide-menu" >Quản trị viên</span></a> </li>
            @endcan
            @can('read-acl')
            <li><a href="#" class="waves-effect"><i class="icon-layers mr-3"></i><span class="hide-menu"> Vai trò & Quyền <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">2</span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ route('roles.index') }}"><i class="icon-magic-wand mr-3"></i>Vai trò</a></li>
                    <li> <a href="{{ route('permissions.index') }}"><i class="icon-shield mr-3"></i>Quyền</a></li>
                </ul>
            </li>
            @endcan
            @can('read-mangas')
                <li><a href="{{ route('mangas.index') }}" class="waves-effect"><i class="icon-book-open mr-3"></i><span class="hide-menu" >Mangas</span></a> </li>
            @endcan
            @can('read-genres')
                <li><a href="{{ route('genres.index') }}" class="waves-effect"><i class="icon-star mr-3"></i><span class="hide-menu" >Thể Loại</span></a> </li>
            @endcan
            @can('read-authors')
                <li><a href="{{ route('authors.index') }}" class="waves-effect"><i class="icon-graduation mr-3"></i><span class="hide-menu" >Tác giả</span></a> </li>
            @endcan
            @can('read-teams')
                <li><a href="{{ route('translate-teams.index') }}" class="waves-effect"><i class="icon-graduation mr-3"></i><span class="hide-menu" >Nhóm dịch</span></a> </li>
            @endcan
        </ul>
    </div>
</div>