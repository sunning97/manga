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
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Admin</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <ul class="nav customtab2 nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item"><a href="#home6" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Tài khoản đã kíck hoạt</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#profile6" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Tài khoản chưa kích hoạt</span></a></li>
                </ul>
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <b>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th class="text-center">Ảnh đại diện</th>
                                    <th class="text-center">Hành động</th>
                                </b>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(admin,index) in adminActive.data">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ admin.f_name+' '+admin.l_name }}</td>
                                <td>@{{ admin.email }}</td>
                                <td>@{{ index }}</td>
                                <td>@{{ index }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection