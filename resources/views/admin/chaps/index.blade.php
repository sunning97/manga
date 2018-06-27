@extends('admin.layouts.app')

@section('title','Quản Lý Chap')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Chap</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Chap</li>
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
                                <th style="width: 300px;">Tiêu đề</th>
                                <th>Ngày đăng</th>
                                <th>Người đăng</th>
                                <th>Người update</th>
                                <th class="text-center">Action</th>
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($chaps as $chap)
                            <tr>
                                <td><b>{{ $chap->name }}</b></td>
                                <td>
                                    {{ $chap->created_at->format('d-m-Y') }}
                                </td>
                                <td><b>{{ $chap->postBy->f_name .' '. $chap->postBy->l_name }}</b></td>
                                <td><b>
                                        @if($chap->updateBy)
                                            {{ $chap->updateBy->f_name .' ' . $chap->updateBy->l_name}}
                                        @else
                                            Không có
                                        @endif
                                    </b></td>
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        @can('read-chaps')
                                            <a href="{{ route('chaps.show',$chap->id) }}" class="btn btn-success btn-sm text-sm-center">Xem <i class="ti-eye"></i></a>
                                        @endcan
                                        @can('update-chaps')
                                            <a href="{{ route('chaps.edit',$chap->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        @endcan
                                        @can('delete-chaps')
                                            <button type="button" class="btn btn-danger btn-sm">Xóa <i class="ti-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5" class="text-center">Không có dữ liệu</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {{ $chaps->render('admin.mangas.pagination_chap') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection