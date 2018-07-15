@extends('admin.layouts.app')

@section('title',$manga->name.': Cập nhật')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugin/dropify/dist/css/dropify.min.css') }}">
    <link href="{{ asset('assets/admin/plugin/summernote/dist/summernote.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title" data-id="{{ $manga->id }}" data-name="{{ $manga->name }}"></h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('mangas.index') }}">Mangas</a></li>
                <li class="active">{{ $manga->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" action="{{ route('mangas.update',$manga->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-md-12">Tiêu đề</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" v-model="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12" for="example-email">Tên khác</label>
                                <div class="col-md-12">
                                    <input type="text" name="other_name" class="form-control" value="{{ $manga->other_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12" for="slug_name">Slug</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="slug_name" class="form-control" :value="getSlug(name)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-md-12">Mô tả</label>
                                <div class="col-md-12">
                                    <textarea class="form-control summernote" rows="5" name="description">{{ $manga->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-md-12">Nguồn truyện</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="origin" value="{{ $manga->origin }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="col-md-12">Nhóm dịch</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Chọn tác giả" name="teams[]">
                                @foreach($manga->teams as $team)
                                    <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                                @endforeach
                                <option v-for="team in teams" :value="team.id">@{{ team.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="col-md-12">Tác giả</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Chọn tác giả" name="authors[]">
                            @foreach($manga->authors as $author)
                                    <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                            @endforeach
                                <option v-for="author in authors" :value="author.id">@{{ author.name }}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="col-md-12">Thể loại</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Chọn thể loại" name="genres[]">
                            @foreach($manga->genres as $genre)
                                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                            @endforeach
                                <option v-for="genre in genres" :value="genre.id">@{{ genre.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="checkbox checkbox-inverse mt-5">
                        <input id="checkbox6c" type="checkbox" v-model="isCoverChecked">
                        <label for="checkbox6c"> Cập nhật cover </label>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-md-12">Ảnh cover</label>
                                <input type="file" id="input-file-now" name="cover" data-default-file="{{ asset('uploads/manga-covers/'.$manga->cover) }}" class="dropify" :disabled="!isCoverChecked" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/summernote/dist/summernote.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/manga-edit.js') }}"></script>
@endsection