@extends('admin.layouts.app')

@section('title','Cập nhật vai trò')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Cập nhật vai trò</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('admins.index') }}">Admin</a></li>
                <li class="active" data-role ="{{ $admin->role()->first()->id }}">{{ "$admin->f_name $admin->l_name"}}</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-left"><b>Vai trò hiện tại</b></h4>
                        <h5>{{ $admin->role()->first()->name }}</h5>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('admins.update',$admin->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-8">Chọn vai trò</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select col-12" name="role">
                                            <option v-for="role in roles" :value="role.id" v-if="current_role != role.id">@{{ role.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:200px">Tên</th>
                                    <th>Level</th>
                                    <th>Mô tả</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="role in roles">
                                    <td>@{{ role.name }}</td>
                                    <td>@{{ role.level }}</td>
                                    <td>@{{ role.description }}</td>
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
    <script src="{{ asset('js/admin-edit.js') }}"></script>
@endsection