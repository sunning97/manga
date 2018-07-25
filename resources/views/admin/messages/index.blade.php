@extends('admin.layouts.app')

@section('title','Message')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title" id="mess">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Trò chuyện</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Trò chuyện</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- .row -->
    <!-- .chat-row -->
    <div class="chat-main-box" id="app">
        <message-box :user="{{ auth()->guard('admin')->user() }}"></message-box>
    </div>
    <!-- /.chat-row -->
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
    <script src="{{ asset('js/message.js') }}"></script>
@endsection