@extends('admin.layouts.app')

@section('title','Quản Lý Nhóm dich')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Nhóm dich</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">nhóm dịch</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" v-model="name" placeholder="Nhập tên nhóm...">
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
                        <div v-if="name.length > 0 && searchResult.length > 0">
                            <tr v-for="(team,index) in searchResult">
                                <td>@{{ index+1 }}</td>
                                <td><b>@{{ team.name }}</b></td>
                                <td>@{{ team.description }}</td>
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        <a href="" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        <a href="" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" @click="showDelete" data-href="">Xóa <i class="ti-trash" data-href=""></i></button>
                                    </div>
                                </td>
                            </tr>
                        </div>
                        <tr class="text-center">
                            <td colspan="4" v-if="name.length > 0 && searchResult.length == 0"><b>Không tìm thấy dữ liệu phù hợp</b></td>
                        </tr>
                        @forelse($teams as $team)
                            <tr v-if="name.length == 0 && searchResult.length == 0">
                                <td>{{ $team->id }}</td>
                                <td><b>{{ $team->name }}</b></td>
                                <td>{!! $team->description !!}</td>
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        <a href="{{ route('translate-teams.show',$team->id) }}" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        <a href="{{ route('translate-teams.edit',$team->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" @click="showDelete" data-href="">Xóa <i class="ti-trash" data-href=""></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="4" class="text-center">Không có dữ liệu</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-right" v-if="name.length == 0 && searchResult.length == 0">{{ $teams->render('admin.teams.pagination') }}</div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/sweetalert/sweetalert.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/translate-team.js') }}"></script>
@endsection