@extends('admin.layouts.app')

@section('title','Cập nhật: '.$chap->name)

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/plugin/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugin/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title" data-name="{{ $chap->name }}" data-id="{{ $chap->id }}"></h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('mangas.show',$chap->manga->id) }}">{{ $chap->manga->name }}</a></li>
                <li class="active">{{ $chap->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item"><a href="#info" class="nav-link active" aria-controls="info" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Thông tin</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#image" class="nav-link" aria-controls="image" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"> Thêm hình</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#edit_image" @click="getChapImages" class="nav-link" aria-controls="edit_image" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"> Sửa hình</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="info">
                        <form class="form-horizontal" method="post" action="{{ route('chaps.update',$chap->id) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Tên Chap</label>
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
                                    <div class="form-group">Chọn truyện</label>
                                        <select class="form-control select2" name="manga_id" required>
                                            @foreach($mangas as $manga)
                                                @if($manga->id == $chap->manga_id)
                                                    <option value="{{ $manga->id }}" selected>{{ $manga->name }}</option>
                                                @else
                                                    <option value="{{ $manga->id }}">{{ $manga->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
                    <div role="tabpanel" class="tab-pane fade" id="image">
                        <form action="{{ route('chaps.image',$chap->id) }}" class="dropzone" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="fallback">
                                <input type="file" name="file" accept="image/*" multiple="multiple"/>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="edit_image">
                        <div class="row el-element-overlay m-b-40">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" v-for="(image,index) in chapImage">
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img :src="'{{ asset('uploads/chap-images/') }}/'+image.image" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li><a class="btn default btn-outline" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat" @click="showEdit(index)"><i class="ti-pencil"></i></a></li>
                                                    <li><a class="btn default btn-outline" @click="showDelete(index)"><i class="ti-trash"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="el-card-content">
                                            <h5 class="text-center">@{{ image.image }}</h5>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-center" v-if="chapImage.length == 0">Không có hình nào</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Sửa hình</h4> </div>
                    <div class="modal-body">
                        <form>
                            <div class="row mt-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="file" id="input-file-now" data-height="300" class="dropify" required/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <img class="img-responsive" :src="'{{ asset('uploads/chap-images/') }}/'+imageEdit.image" alt="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="editImage" data-dismiss="modal">Cập nhật</button>
                    </div>
                </div>
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
    <script src="{{ asset('assets/admin/plugin/dropzone-master/dist/dropzone.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/chap-edit.js') }}"></script>
@endsection