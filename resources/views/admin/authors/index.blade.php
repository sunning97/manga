@extends('admin.layouts.app')

@section('title','Quản Lý Tác giả')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/plugin/alertifyjs/css/alertify.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tác giả</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Tác giả</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên tác giả..." v-model="name">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <b>
                                <th>#</th>
                                <th style="width: 200px;">Tên</th>
                                <th>Mô tả</th>
                                <th>Create at</th>
                                @if(auth()->guard('admin')->user()->hasPermission('update-authors') || auth()->guard('admin')->user()->hasPermission('delete-authors'))
                                    <th class="text-center">Action</th>
                                @endif
                            </b>
                        </tr>
                        </thead>
                        <tbody v-if="searchResult.length == 0 && name.length == 0">
                        @php
                            $i = $page+1;
                        @endphp
                        @forelse($authors as $author)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->description }}</td>
                                <td>{{ $author->created_at->format('d-m-Y') }}</td>
                                @if(auth()->guard('admin')->user()->hasPermission('update-authors') || auth()->guard('admin')->user()->hasPermission('delete-authors'))
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        @can('update-authors')
                                            <a href="{{ route('authors.edit',$author->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        @endcan
                                        @can('delete-authors')
                                            <button type="button" class="btn btn-danger btn-sm" @click="showDelete" data-url="{{ url('/admin') }}" data-id="{{ $author->id }}">Xóa <i class="ti-trash" data-url="{{ url('/admin') }}" data-id="{{ $author->id }}"></i></button>
                                        @endcan
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @empty
                            <td colspan="5" class="text-center"><h4>Không có dữ liệu</h4></td>
                        @endforelse
                        </tbody>
                        <tbody v-if="searchResult.length > 0 && name.length > 0">
                            <tr v-for="(author,index) in searchResult">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ author.name }}</td>
                                <td>@{{ author.description }}</td>
                                <td>@{{ date_format(author.created_at) }}</td>
                                @if(auth()->guard('admin')->user()->hasPermission('update-authors') || auth()->guard('admin')->user()->hasPermission('delete-authors'))
                                    <td class="text-center">
                                        <div class="btn-group m-b-20">
                                            @can('update-authors')
                                                <a href="" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                            @endcan
                                            @can('delete-authors')
                                                <button type="button" class="btn btn-danger btn-sm">Xóa <i class="ti-trash"></i></button>
                                            @endcan
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                        <tr class="text-center" v-if="searchResult.length == 0 && name.length > 0">
                            <td colspan="5"><b>Không tìm thấy dữ liệu phù hợp</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/alertifyjs/alertify.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/author.js') }}"></script>
@endsection