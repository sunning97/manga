@extends('admin.layouts.app')

@section('title','Thêm mới thể loại')

@section('plugin_css')
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Thêm mới thể loại</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('mangas.index') }}">Thể loại</a></li>
                <li class="active">Thêm mới thể loại</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" action="{{ route('genres.store') }}">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12" id="genre-name" data-name="@if(session()->has('data')){{ session('data')['name'] }}@endif">Tên thể loại</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" v-model="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12">Tên Slug</label>
                                <div class="col-md-12">
                                    <input readonly type="text" class="form-control" name="slug_name" :value="getSlug(name)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">Mô tả</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" name="description">@if(session()->has('data')){{ session('data')['description'] }}@endif</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Thêm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
    <script src="{{ asset('js/genre-create.js') }}"></script>
@endsection