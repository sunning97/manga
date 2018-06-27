@extends('admin.layouts.app')

@section('title','Quản Lý Tác giả')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tác giả</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Tác giả</li>
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
                                <th style="width: 200px;">Tên</th>
                                <th>Mô tả</th>
                                <th>Create at</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('update-authors') || \Illuminate\Support\Facades\Auth::user()->hasPermission('delete-authors'))
                                    <th class="text-center">Action</th>
                                @endif
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->description }}</td>
                                <td>{{ $author->created_at->format('d-m-Y') }}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('update-authors') || \Illuminate\Support\Facades\Auth::user()->hasPermission('delete-authors'))
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
                        @empty
                            <td colspan="5" class="text-center"><h4>Không có dữ liệu</h4></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection