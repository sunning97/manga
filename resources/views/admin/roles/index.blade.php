@extends('admin.layouts.app')

@section('title','Quản Lý Role')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Roles</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Roles</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Nhập tên..." v-model="name">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <b>
                                <th>#</th>
                                <th style="width: 200px;">Tên</th>
                                <th>Mô tả</th>
                                <th class="text-center">Level</th>
                                @if(auth()->guard('admin')->user()->hasPermission('read-acl') || auth()->guard('admin')->user()->hasPermission('delete-acl') ||auth()->guard('admin')->user()->hasPermission('update-acl'))
                                <th class="text-center">Hành động</th>
                                @endif
                            </b>
                        </tr>
                        </thead>
                        <tbody v-if="searchResult.length == 0 && name.length == 0">
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td class="text-center">{{ $role->level }}</td>
                                @if(auth()->guard('admin')->user()->hasPermission('read-acl') || auth()->guard('admin')->user()->hasPermission('delete-acl') ||auth()->guard('admin')->user()->hasPermission('update-acl'))
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        @can('read-acl')
                                        <a href="{{ route('roles.show',$role->id) }}" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        @endcan
                                        @can('update-acl')
                                        <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        @endcan
                                        @can('delete-acl')
                                            <button type="button" class="btn btn-danger btn-sm">Xóa <i class="ti-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Không có dữ liệu</td>
                        @endforelse
                        </tbody>
                        <tbody v-if="searchResult.length > 0 && name != ''">
                            <tr v-for="(role,index) in searchResult">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ role.name }}</td>
                                <td>@{{ role.description }}</td>
                                <td class="text-center">@{{ role.level }}</td>
                                @if(auth()->guard('admin')->user()->hasPermission('read-acl') || auth()->guard('admin')->user()->hasPermission('delete-acl') ||auth()->guard('admin')->user()->hasPermission('update-acl'))
                                    <td class="text-center">
                                        <div class="btn-group m-b-20">
                                            @can('read-acl')
                                                <a href="" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                            @endcan
                                            @can('update-acl')
                                                <a href="" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                            @endcan
                                            @can('delete-acl')
                                                <button type="button" class="btn btn-danger btn-sm">Xóa <i class="ti-trash"></i></button>
                                            @endcan
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                        <tbody v-if="searchResult.length == 0 && name != ''">
                            <tr>
                                <td colspan="5" class="text-center"><b>Không tìm thấy dữ liệu phù hợp</b></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                {{ $roles->render('admin/roles.pagination') }}
                <p class="text-muted m-b-30 font-15">
                    <b>*Note:</b> Level càng thấp thì quyền hạn của vai trò càng cao<br>
                    <b>Super Administrator</b> là vai trò có quyền cao nhất trong hệ thống
                </p>
            </div>

        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
    <script src="{{ asset('js/role.js') }}"></script>
@endsection