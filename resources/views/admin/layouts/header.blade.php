<div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
    <!-- Logo -->
    <div class="top-left-part">
        <a class="logo" href="{{ route('admin.dashboard') }}">
            <b><img src="{{ asset('assets/admin/images/eliteadmin-logo.png') }}" alt="home" /></b>
            <span class="hidden-xs"><img src="{{ asset('assets/admin/images/eliteadmin-text.png') }}" alt="home" /></span> </a>
    </div>
    <!-- /Logo -->
    <!-- This is for mobile view search and menu icon -->
    <ul class="nav navbar-top-links navbar-left hidden-xs">
        <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
        <li>
        <li class="dropdown">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"><b class="hidden-xs"><i class="icon-plus"></i> Tạo Mới</b></a>
            <ul class="dropdown-menu dropdown-user animated flipInY">
                @can('create-admins')
                    <li><a href="{{ route('admins.create') }}"><i class="icon-user mr-3"></i> Quản trị viên</a></li>
                    <li role="separator" class="divider"></li>
                @endcan
                @can('create-acl')
                    <li><a href="{{ route('roles.create') }}"><i class="icon-magic-wand mr-3"></i> Vai trò</a></li>
                    <li role="separator" class="divider"></li>
                @endcan
                @can('create-acl')
                    <li><a href="{{ route('permissions.create') }}"><i class="icon-shield mr-3"></i> Quyền</a></li>
                    <li role="separator" class="divider"></li>
                @endcan
                @can('create-genres')
                    <li><a href="{{ route('genres.create') }}"><i class="icon-star mr-3"></i> Thể Loại</a></li>
                    <li role="separator" class="divider"></li>
                @endcan
                @can('create-authors')
                    <li><a href="{{ route('authors.create') }}"><i class="icon-graduation mr-3"></i> Tác Giả</a></li>
                    <li role="separator" class="divider"></li>
                @endcan
                @can('create-mangas')
                    <li><a href="{{ route('mangas.create') }}"><i class="icon-book-open mr-3"></i> Manga</a></li>
                    <li role="separator" class="divider"></li>
                @endcan
                @can('create-teams')
                    <li><a href="{{ route('translate-teams.create') }}"><i class="icon-book-open mr-3"></i> Team dịch</a></li>
                @endcan
            </ul>
            <!-- /.dropdown-user -->
        </li>
    </ul>
    <!-- This is the message dropdown -->
    <ul class="nav navbar-top-links navbar-right pull-right">
        <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
        <!-- /.dropdown -->
    </ul>
</div>