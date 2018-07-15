@extends('admin.layouts.app')

@section('title',$team->name.' :cập nhật')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title" data-name="{{ $team->name }}"></h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('translate-teams.index') }}">Permission</a></li>
                <li class="active">Cập nhật</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" action="{{ route('translate-teams.update',$team->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12">Tên nhóm dich</label>
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
                                    <textarea class="form-control" rows="5" name="description">{{ $team->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="">Trạng thái</h5>
                            <select class="selectpicker" data-style="form-control" name="state">
                                <option value="ACTIVATE" @if($team->state == 'ACTIVATE') selected @endif>Hoạt động</option>
                                <option value="INACTIVE" @if($team->state == 'INACTIVE') selected @endif>Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="checkbox checkbox-inverse">
                                <input id="checkbox6c" type="checkbox" v-model="isChangeAvatar" name="isChangeAvatar">
                                <label for="checkbox6c"> Cập nhật ảnh đại diện </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <label class="col-md-12">Ảnh đại diện</label>
                                <input type="file" id="input-file-now" name="avatar" accept="image/*" data-default-file="{{ asset('uploads/team-avatars/'.$team->avatar) }}" :required="isChangeAvatar" class="dropify" :disabled="!isChangeAvatar"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/dropify/dist/js/dropify.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/translate-team-edit.js') }}"></script>
@endsection