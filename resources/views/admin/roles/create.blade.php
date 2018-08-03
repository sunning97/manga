@extends('admin.layouts.app')

@section('title','Thêm mới Role')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Thêm mới Role</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="active" data-name="{{ old('name') }}">Thêm mới</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" action="{{ route('roles.store') }}">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12">Tên Role</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" v-model="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12">Tên Slug</label>
                                <div class="col-md-12">
                                    <input readonly type="text" class="form-control" name="slug_name" :value="getSlug(name)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-group">Mô tả</label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="5" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <label class="form-group">Chọn level</label>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="custom-select col-12" id="level" name="level">
                                        <option v-for="(level,index) in levels" :value="level" :selected="index === 0">Level @{{ level }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-group">Các vai trò đang có</label>
                            <p class="text-muted m-b-30 font-13">
                                <b>*Note:</b> Level càng thấp thì quyền hạn của vai trò càng cao<br>
                                <b>Super Administrator</b> là vai trò có quyền cao nhất trong hệ thống
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th class="text-center">Level</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="role in roles">
                                        <td><b>@{{ role.name }}</b></td>
                                        <td class="text-center">@{{ role.level }}</td>
                                    </tr>
                                    </tbody>
                                </table>
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
@endsection

@section('custom_js')
    <script src="{{ asset('js/role-create.js') }}"></script>
@endsection