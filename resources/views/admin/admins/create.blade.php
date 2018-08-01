@extends('admin.layouts.app')

@section('title','Thêm mới Admin')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Thêm mới Admin</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('admins.index') }}">Admin</a></li>
                <li class="active">Thêm mới Admin</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form action="{{ route('admins.store') }}" method="post" id="signupForm">
                    @csrf
                    @method('post')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Họ</label>
                                    <input type="text" id="f_name" class="form-control" placeholder="" name="f_name"></div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên</label>
                                    <input type="text" id="l_name" class="form-control" placeholder="" name="l_name"></div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Giới tính</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="MALE">Nam</option>
                                        <option value="FEMALE">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Sinh nhật</label>
                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" data-inputmask="'alias': 'date'" name="birth_date" id="birth_date"> </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="" data-inputmask="'alias': 'email'"></div>
                            </div>
                        </div>
                        <!--/row-->

                        <h3 class="box-title m-t-40">Địa chỉ</h3>
                        <hr>
                        <div class="checkbox checkbox-inverse">
                            <input type="checkbox" v-model="isAddress">
                            <label> Thêm địa chỉ </label>
                        </div>
                        <div v-if="isAddress">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12">Chọn Tỉnh/Thành phố</label>
                                        <select class="custom-select col-12" id="province" name="province" @change="getDistricts">
                                            <option selected></option>
                                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12">Chọn Quận/Huyện</label>
                                        <select class="custom-select col-12" id="district" name="district" :disabled="!isProvince" @change="getWards">
                                            <option selected></option>
                                            <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12">Chọn Phường/Xã</label>
                                        <select class="custom-select col-12" id="ward" name="ward" :disabled="!isDistrict">
                                            <option selected></option>
                                            <option v-for="ward in wards" :value="ward.id">@{{ ward.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên đường, số nhà</label>
                                        <input type="text" name="street" class="form-control" id="street"> </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="box-title m-t-40">Mật khẩu</h3>
                        <p class="text-muted m-b-30 font-13">Mật khẩu mặc định cho tài khoản admin này là <b>"password"</b></p>

                        <div class="checkbox checkbox-inverse">
                            <input type="checkbox" v-model="isPassword">
                            <label>Thay đổi mật khẩu</label>
                        </div>
                        <div class="form-group" v-if="isPassword">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Mật khẩu</label>
                                    <input id="password" class="form-control" name="password" type="password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm_password">Nhập lại mật khẩu</label>
                                    <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-right mt-5">
                        <button type="submit" class="btn btn-success">Tạo Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/inputmask/dist/inputmask/phone-codes/phone.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/inputmask/dist/inputmask/phone-codes/phone-be.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/inputmask/dist/inputmask/phone-codes/phone-ru.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/inputmask/dist/inputmask/bindings/inputmask.binding.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/admin-create.js') }}"></script>
@endsection