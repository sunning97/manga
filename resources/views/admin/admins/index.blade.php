@extends('admin.layouts.app')

@section('title','Quản Lý Admin')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Starter Page </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Admin</li>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th class="text-center">Avatar</th>
                            <th class="text-center">Action</th>
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->f_name }} {{ $admin->l_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role()->first()->name }}</td>
                            <td class="text-center"><img class="img-circle" src="{{ asset('uploads/admins-avatar/'.$admin->avatar) }}" alt="{{ $admin->f_name }} {{ $admin->l_name }}" style="width: 40px;height: auto"></td>
                            <td class="text-center">
                                <div class="btn-group m-b-20">
                                    <a href="{{ route('admins.show',$admin->id) }}" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                    @can('update-admins')
                                    <a class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                    @endcan
                                    @can('delete-admins')
                                    <button type="button" class="btn btn-danger btn-sm">Xóa <i class="ti-trash"></i></button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $admins->render('admin/admins.pagination') }}
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection