@extends('admin.layouts.app')

@section('title',$chap->name)

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"></h4> </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('mangas.show',$chap->manga->id) }}">{{ $chap->manga->name }}</a></li>
                <li class="active">{{ $chap->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="text-left"><b>{{ $chap->name }}</b><a href="{{ route('chaps.edit',$chap->id) }}" class="btn btn-success btn-sm waves-effect ml-5">Sửa</a></h3>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Người đăng</th>
                                <td><b>{{ $chap->postBy->f_name .' '.$chap->postBy->l_name}}</b></td>
                            </tr>
                            <tr>
                                <th>Ngày đăng</th>
                                <td><b>{{ $chap->format_time($chap->created_at) }}</b></td>
                            </tr>
                            @if($chap->updateBy)
                            <tr>
                                <th>Cập nhật cuối cùng</th>
                                <td><b>{{ $chap->updateBy->f_name .' '.$chap->updateBy->l_name}}</b></td>
                            </tr>
                            <tr>
                                <th>Ngày cập nhật</th>
                                <td><b>{{ $chap->format_time($chap->updated_at) }}</b></td>
                            </tr>
                            @else
                                <tr>
                                    <th>Cập nhật cuối cùng</th>
                                    <td><b>Không có</b></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-5">
                        @forelse($images as $image)
                        <div class="col-12 mt-5">
                            <img src="{{ asset('uploads/chap-images/'.$image->image) }}" alt="{{ $chap->name }}" class="img-responsive text-center">
                        </div>
                        @empty
                            <h4 class="text-center">Không có ảnh nào</h4>
                        @endforelse

                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection