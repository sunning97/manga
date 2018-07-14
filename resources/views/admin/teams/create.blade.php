@extends('admin.layouts.app')

@section('title','Thêm mới nhóm dich')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Thêm mới nhóm dịch</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('translate-teams.index') }}">Nhóm dịch</a></li>
                <li class="active">Thêm mới</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" action="{{ route('translate-teams.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12" id="team-name" data-name="@if(session()->has('data')){{ session('data')['name'] }}@endif">Tên nhóm dich</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" v-model="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6" >
                            <div class="form-group">
                                <label class="col-md-12">Tên Slug</label>
                                <div class="col-md-12">
                                    <input readonly type="text" class="form-control" name="slug_name"
                                           :value="getSlug(name)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">Mô tả</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" name="description">@if(session()->has('data')){{ session('data')['description'] }}@endif</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="col-md-12" id="leader" data-leader="@if(session()->has('data')){{ session('data')['leader'] }}@endif">Trưởng nhóm</label>
                            <select class="form-control select2" name="leader" required>
                                <option>Không có</option>
                                <option v-for="user in users" :value="user.id" selected>@{{ user.f_name + ' ' + user.l_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="checkbox checkbox-inverse">
                                <input id="checkbox6c" type="checkbox" v-model="isUseDefault" name="isUseDefault">
                                <label for="checkbox6c"> Dùng ảnh đại diện mặc định </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" v-show="!isUseDefault">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-md-12">Ảnh đại diện</label>
                                <input type="file" id="input-file-now" name="avatar" :required="!isUseDefault" class="dropify"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Thêm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/dropify/dist/js/dropify.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/translate-team-create.js') }}"></script>
@endsection