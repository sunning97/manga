@extends('admin.layouts.app')

@section('title','Thông tin Admin: '.$admin->f_name.' '.$admin->l_name)

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $admin->f_name }} {{ $admin->l_name }}</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('admins.index') }}">Admin</a></li>
                <li class="active">{{ $admin->f_name }} {{ $admin->l_name }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="../plugins/images/large/img1.jpg">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{ asset('uploads/admins-avatar/'.$admin->avatar) }}" class="thumb-lg img-circle" alt="img"></a>
                            <h4 class="text-white">{{ $admin->f_name }} {{ $admin->l_name }}</h4>
                            <h5 class="text-white">{{ $admin->role()->first()->name }}</h5>
                            <h5 class="text-white">{{ $admin->email }}</h5> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item"><a href="#information" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Thông tin</span></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="information">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Họ và tên</th>
                                    <td>{{ $admin->f_name. ' '.$admin->l_name }}</td>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <td>{{ ($admin->gender=='MALE')?'Nam':'Nữ' }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày-tháng-năm sinh:</th>
                                    <td>{{ date('d-m-Y', strtotime($admin->birth_date)) }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại:</th>
                                    <td>{{ $admin->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $admin->address }}</td>
                                </tr>
                                </tbody>
                            </table>
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