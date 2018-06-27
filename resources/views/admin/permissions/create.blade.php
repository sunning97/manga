@extends('admin.layouts.app')

@section('title','Thêm mới Permission')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Thêm mới Permission</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('permissions.index') }}">Permission</a></li>
                <li class="active">Thêm mới</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" action="{{ route('permissions.store') }}">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-3">
                            <div class="radio radio-custom">
                                <input type="radio" name="radio" id="radio2" value="basic" v-model="type" @click="resetName" checked>
                                <label for="basic"> Cơ bản </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="radio radio-custom">
                                <input type="radio" name="radio" id="radio2" value="advance" @click="resetName" v-model="type">
                                <label for="advance"> Nâng cao </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" v-if="type=='basic'">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12">Tên Role</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" v-model="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6" v-if="type=='basic'">
                            <div class="form-group">
                                <label class="col-md-12">Tên Slug</label>
                                <div class="col-md-12">
                                    <input readonly type="text" class="form-control" name="slug_name"
                                           :value="getSlug(name)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="type=='basic'">
                        <div class="col-12">
                            <div class="form-group">Mô tả</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" v-if="type=='advance'">
                        <div class="col-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-md-12">Role</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="name" v-model="name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="checkbox checkbox-inverse">
                                        <input id="checkbox6c" type="checkbox" value="create" v-model="checkedType" checked>
                                        <label for="checkbox6c"> Create </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="checkbox checkbox-inverse">
                                        <input id="checkbox6c" type="checkbox" value="update" v-model="checkedType" checked>
                                        <label for="checkbox6c"> Update </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="checkbox checkbox-inverse">
                                        <input id="checkbox6c" type="checkbox" value="read" v-model="checkedType" checked>
                                        <label for="checkbox6c"> Read </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="checkbox checkbox-inverse">
                                        <input id="checkbox6c" type="checkbox" value="delete" v-model="checkedType" checked>
                                        <label for="checkbox6c"> Delete </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="table-responsive" v-if="checkedType.length > 0 && name.length>0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <b>
                                            <th>Tên</th>
                                            <th>Tên Slug</th>
                                            <th>Mô Tả</th>
                                        </b>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="type in checkedType">
                                            <td v-if="type == 'create'">Thêm @{{ getUcFirst(' '+name) }}</td>
                                            <td v-else-if="type == 'update'">Cập Nhật @{{ getUcFirst(' '+name) }}</td>
                                            <td v-else-if="type == 'read'">Xem @{{ getUcFirst(' '+name) }}</td>
                                            <td v-else-if="type == 'delete'">Xóa @{{ getUcFirst(' '+name) }}</td>
                                            <td>@{{ getSlug(type+' '+name) }}</td>
                                            <td v-if="type == 'create'">Cho phép người dùng thêm mới @{{ getUcFirst(name) }}</td>
                                            <td v-else-if="type == 'update'">Cho phép người dùng cập nhật @{{ getUcFirst(name) }}</td>
                                            <td v-else-if="type == 'read'">Cho phép người dùng xem @{{ getUcFirst(name) }}</td>
                                            <td v-else-if="type == 'delete'">Cho phép người dùng xóa @{{ getUcFirst(name) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="type=='advance' && name.length > 0">
                        <div class="col-12">
                            <div class="form-group" v-for="(item,index) in namePut">
                                <div class="col-md-12">
                                    <input type="hidden" class="form-control" :name="'put'+index" :value="item +'|'+ slugPut[index] +'|'+ desPut[index]">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="total" :value="namePut.length">
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
    <script src="{{ asset('js/permission-create.js') }}"></script>
@endsection