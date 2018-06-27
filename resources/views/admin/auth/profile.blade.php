@extends('admin.layouts.app')

@section('title','Trang cá nhân: '.$admin->f_name.' '.$admin->l_name)

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"></h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Trang cá nhân</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"><img width="100%" alt="user" src="../plugins/images/large/img1.jpg">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{ asset('uploads/admins-avatar/'.$admin->avatar) }}" class="thumb-lg img-circle" alt="img"></a>
                            <h4 class="text-white">{{ $admin->f_name }} {{ $admin->l_name }}</h4>
                            <h5 class="text-white">{{ $admin->email }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item"><a href="#information" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Thông tin</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#avatar" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs"> Ảnh đại diện</span></a>
                    </li>
                    <li role="presentation" class="nav-item"><a href="#password" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs"> Mật khẩu</span></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="information">
                        <div class="checkbox checkbox-inverse">
                            <input id="checkbox6c" type="checkbox" v-model="isChangeInfo">
                            <label for="checkbox6c"> Cập nhật thông tin </label>
                        </div>

                        <form class="form-horizontal mt-5" method="post" action="{{ route('admin.profile.update') }}">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Họ</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="f_name" value="{{ $admin->f_name }}" :disabled="!isChangeInfo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Tên</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="l_name" value="{{ $admin->l_name }}" :disabled="!isChangeInfo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email" value="{{ $admin->email }}" :disabled="!isChangeInfo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Sinh nhật</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/YYYY" name="birth_date" value="{{ date('d-m-Y', strtotime($admin->birth_date)) }}" :disabled="!isChangeInfo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Số điện thoại</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phone" value="{{ $admin->phone }}" :disabled="!isChangeInfo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Giới tính</label>
                                @if($admin->gender === 'MALE')
                                    <div class="radio">
                                        <input type="radio" name="gender" value="MALE" checked :disabled="!isChangeInfo">
                                        <label for="radio11"> Nam </label>
                                    </div>

                                    <div class="radio">
                                        <input type="radio" name="gender" value="FEMALE" :disabled="!isChangeInfo">
                                        <label for="radio11"> Nữ </label>
                                    </div>
                                @else
                                    <div class="radio">
                                        <input type="radio" name="gender" value="MALE" :disabled="!isChangeInfo">
                                        <label for="radio11"> Nam </label>
                                    </div>

                                    <div class="radio">
                                        <input type="radio" name="gender" value="FEMALE" checked
                                               :disabled="!isChangeInfo">
                                        <label for="radio11"> Nữ </label>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Địa chỉ</label>
                                <div class="checkbox checkbox-inverse" v-if="isChangeInfo">
                                    <input id="checkbox6" type="checkbox" v-model="isChangeAddress">
                                    <label for="checkbox6"> Cập nhật địa chỉ </label>
                                </div>
                                <div class="col-md-12 mt-5" v-if="!isChangeAddress">
                                    <input readonly type="text" class="form-control" value="{{ $admin->address }}">
                                </div>
                                <div class="row mt-5" v-if="isChangeAddress">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label">Tỉnh/TP</label>
                                            <select class="form-control" name="province" v-model="provinceId"
                                                    @change="getDistricts(provinceId)">
                                                <option v-for="province in provinces" :value="province.id">@{{
                                                    province.type }} @{{ province.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label">Quận/Huyện</label>
                                            <select class="form-control" name="district" v-model="districtId"
                                                    @change="getWards(districtId)" :disabled="!isProvinceSelected">
                                                <option v-for="district in districts" :value="district.id">@{{
                                                    district.type }} @{{ district.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label">Phường/Xã</label>
                                            <select class="form-control" name="ward" :disabled="!isDistrictSelected">
                                                <option v-for="ward in wards" :value="ward.id">@{{ ward.type }} @{{
                                                    ward.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" v-if="isChangeAddress">
                                    <label class="col-md-12">Số nhà,tên đường</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="street">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right" v-if="isChangeInfo">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="avatar">
                        <div class="checkbox checkbox-inverse">
                            <input id="checkbox6c" type="checkbox" v-model="isChangeAvatar">
                            <label for="checkbox6c"> Cập nhật ảnh đại diện </label>
                        </div>
                        <form class="form-horizontal" method="post" action="{{ route('admin.update-avatar') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <input type="file" id="input-file-now" data-default-file="{{ asset('uploads/admins-avatar/'.$admin->avatar) }}" name="avatar" class="dropify" required :disabled="!isChangeAvatar"/>
                            </div>
                            <div class="form-group" v-if="isChangeAvatar">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="password">
                        <div class="checkbox checkbox-inverse">
                            <input id="checkbox6c" type="checkbox" v-model="isChangePassword">
                            <label for="checkbox6c"> Cập nhật mật khẩu </label>
                        </div>
                        <form class="form-horizontal" id="passForm" method="post" action="{{ route('admin.update-password') }}">
                            @csrf
                            @method('post')
                            <div class="form-group mt-4" v-if="isChangePassword">
                                <label class="col-md-12">Mật khẩu hiện tại</label>
                                <div class="col-md-12">
                                    <input type="password" name="curr_password" id="curr_password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" v-if="isChangePassword">
                                <label class="col-md-12">Mật khẩu mới</label>
                                <div class="col-md-12">
                                    <input type="password" name="password" id="pass" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" v-if="isChangePassword">
                                <label class="col-md-12">Nhập lại nật khẩu</label>
                                <div class="col-md-12">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-success" v-if="isChangePassword">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/admin/plugin/vue/vue.js') }}"></script>
    <script src="{{ asset('assets/admin/js/mask.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection