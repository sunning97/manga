@extends('admin.layouts.app')

@section('title','Chi tiết người dùng: '.$user->fullName($user->id))

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Người dùng</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('users.index') }}">Người dùng</a></li>
                <li class="active">{{ $user->fullName($user->id) }}</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">

            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection