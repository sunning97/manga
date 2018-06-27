@extends('admin.layouts.app')

@section('title','Quản Lý Permission')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Permission</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Permission</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" v-model="name" placeholder="Nhập tên quyền...">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <b>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th class="text-center">Action</th>
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        <div v-if="searchResult.length > 0 && name.length > 0">
                            <tr v-for="(permission,index) in searchResult">
                                <td>@{{ index+1 }}</td>
                                <td><b>@{{ permission.name }}</b></td>
                                <td>@{{ permission.description }}</td>
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        <a :href="'{{ route('permissions.index') }}/'+permission.id" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        <a :href="'{{ route('permissions.index') }}/'+permission.id+'/edit'" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" @click="showDelete" :data-href="'{{ route('permissions.index') }}/'+permission.id">Xóa <i class="ti-trash" :data-href="'{{ route('permissions.index') }}/'+permission.id"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </div>
                        <tr v-if="searchResult.length == 0 && name.length > 0">
                            <td colspan="4" class="text-center"><b>Không có dữ liệu</b></td>
                        </tr>
                        @forelse($permissions as $permission)
                            <tr v-if="searchResult.length == 0 && name.length == 0">
                                <td>{{ $permission->id }}</td>
                                <td><b>{{ $permission->name }}</b></td>
                                <td>{{ $permission->description }}</td>
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        <a href="{{ route('permissions.show',$permission->id) }}" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" @click="showDelete" data-href="{{ route('permissions.destroy',$permission->id) }}">Xóa <i class="ti-trash" data-href="{{ route('permissions.destroy',$permission->id) }}"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center"><b>Không có dữ liệu</b></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-right" v-if="searchResult.length == 0 && name.length == 0">{{ $permissions->render('admin/permissions.pagination') }}</div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/sweetalert/sweetalert.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/permission.js') }}"></script>
@endsection