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
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <b>
                                <th>#</th>
                                <th style="width: 200px;">Name</th>
                                <th>Description</th>
                                <th style="width: 100px">Create at</th>
                                @if(auth()->guard('admin')->user()->hasPermission('read-acl') || auth()->guard('admin')->user()->hasPermission('delete-acl') ||auth()->guard('admin')->user()->hasPermission('update-acl'))
                                <th class="text-center">Action</th>
                                @endif
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at->format('d-m-Y') }}</td>
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
                    </table>
                </div>
                {{ $roles->render('admin/roles.pagination') }}
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection