@extends('admin.layouts.app')

@section('title',$role->name)

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $role->name }}</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="active">{{ $role->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Tên slug</th>
                                        <td>{{ $role->slug_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả</th>
                                        <td>{{ $role->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{ $role->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cập nhật</th>
                                        <td>{{ $role->updated_at->format('d-m-Y') }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-left">Các quyền đã được cấp</h4>
                            <div class="col-12">
                                <div class="row">
                                    @forelse($permissons as $permisson)
                                        <div class="col-6 mt-3">
                                            <i class="fa fa-check"></i> {{ $permisson->name }}
                                        </div>
                                    @empty
                                        <h5 class="text-center">Chưa được cấp quyền nào!</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection