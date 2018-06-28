@extends('admin.layouts.app')

@section('title',$team->name)

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $team->name }}</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('translate-teams.index') }}">Nhóm dịch</a></li>
                <li class="active">{{ $team->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="col-12">
                    <div class="row">
                        <div class="col-7">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Mô tả</th>
                                        <td>{{ $team->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>@if($team->state=='ACTIVATE')<b class="text-success">Hoạt động</b>@else<b class="text-danger">Không hoạt động</b>@endif</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{ $team->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cập nhật</th>
                                        <td>{{ $team->updated_at->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trưởng nhóm</th>
                                        <td>
                                            @if($team->leader_id)
                                                <div class="row">
                                                    <b class="text-danger"><i class="fa fa-star"></i> {{ $team->leader->f_name.''.$team->leader->l_name }}</b>
                                                </div>
                                            @else
                                                <b>Không có trưởng nhóm</b>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Thành viên</th>
                                        <td>
                                            @if($team->members->all())

                                            @else
                                                <b>Không có thành viên nào</b>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="{{ asset('uploads/team-avatars/'.$team->avatar) }}" alt="{{ $team->name }}" class="img-responsive">
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
@endsection