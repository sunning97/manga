@extends('admin.layouts.app')

@section('title','Quản Lý Manga')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mangas</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Mangas</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <b>
                                <th>#</th>
                                <th style="width: 200px;">Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Cover</th>
                                @if(auth()->guard('admin')->user()->hasPermission('read-mangas') || auth()->guard('admin')->user()->hasPermission('update-mangas') || auth()->guard('admin')->user()->hasPermission('delete-mangas'))
                                <th class="text-center">Action</th>
                                @endif
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($mangas as $manga)
                            <tr>
                                <td>{{ $manga->id }}</td>
                                <td>{{ $manga->name }}</td>
                                <td>{{ $manga->getState($manga->id) }}</td>
                                <td class="text-center"><img src="{{ asset('uploads/manga-covers/'.$manga->cover) }}" alt="" class="img-responsive" style="width: 100px;"></td>
                                @if(auth()->guard('admin')->user()->hasPermission('read-mangas') || auth()->guard('admin')->user()->hasPermission('update-mangas') || auth()->guard('admin')->user()->hasPermission('delete-mangas'))
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        <a href="{{ route('mangas.show',$manga->id) }}" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        @can('update-mangas')
                                            <a href="{{ route('mangas.edit',$manga->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        @endcan
                                        @can('delete-mangas')
                                            <button type="button" class="btn btn-danger btn-sm">Xóa <i class="ti-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @empty
                            <td colspan="5" class="text-center"><h4>Không có dữ liệu</h4></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{--{{ $roles->render('admin/roles.pagination') }}--}}
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection