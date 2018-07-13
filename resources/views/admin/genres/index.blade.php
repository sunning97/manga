@extends('admin.layouts.app')

@section('title','Quản lý thể loại')

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/plugin/alertifyjs/css/alertify.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Thể loại</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('manga.dashboard') }}">Bảng điều khiển</a></li>
                <li class="active">Thể loại</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên thể loại..." v-model="name">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <b>
                                <th>#</th>
                                <th>Tên</th>
                                <th style="width: 500px">Mô tả</th>
                                <th class="text-center">Ngày tạo</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('update-genres') || \Illuminate\Support\Facades\Auth::user()->hasPermission('delete-genres'))
                                    <th class="text-center">Action</th>
                                @endif
                            </b>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-if="searchResult.length == 0 && name.length  > 0">
                            <td colspan="5"><b>Không tìm thấy dữ liệu phù hợp</b></td>
                        </tr>
                        <div v-if="searchResult.lenght > 0 && name.length  > 0">
                            <tr v-for="(genre,index) in searchResult">
                                <td>@{{ index+1 }}</td>
                                <td><b>@{{ genre.name }}</b></td>
                                <td>@{{ genre.description }}</td>
                                <td class="text-center">@{{ date_format(genre.created_at) }}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('update-genres') || \Illuminate\Support\Facades\Auth::user()->hasPermission('delete-genres'))
                                    <td class="text-center">
                                        <div class="btn-group m-b-20">
                                            @can('update-genres')
                                                <a :href="'{{ route('genres.index') }}'+'/'+genre.id+'/edit'" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                            @endcan
                                            @can('delete-genres')
                                                <button type="button" class="btn btn-danger btn-sm" @click="showDelete" :data-href="'{{ route('genres.index') }}/'+genre.id">Xóa <i class="ti-trash" :data-href="'{{ route('genres.index') }}/'+genre.id"></i></button>
                                            @endcan
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        </div>
                        @php
                            $i = ($page-1)*10 +1;
                        @endphp
                        @forelse($genres as $genre)
                            <tr v-if="searchResult.length == 0 && name.length == 0">
                                <td>{{ $i }}</td>
                                <td><b>{{ $genre->name }}</b></td>
                                <td>{{ $genre->description }}</td>
                                <td class="text-center">{{ $genre->created_at->format('d-m-Y') }}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('update-genres') || \Illuminate\Support\Facades\Auth::user()->hasPermission('delete-genres'))
                                <td class="text-center">
                                    <div class="btn-group m-b-20">
                                        @can('update-genres')
                                            <a href="{{ route('genres.edit',$genre->id) }}" class="btn btn-primary btn-sm waves-effect">Sửa <i class="ti-pencil"></i></a>
                                        @endcan
                                        @can('delete-genres')
                                            <button type="button" class="btn btn-danger btn-sm" data-href="{{ route('genres.destroy',$genre->id) }}" @click="showDelete">Xóa <i class="ti-trash" data-href="{{ route('genres.destroy',$genre->id) }}"></i></button>
                                        @endcan
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @empty
                            <td colspan="4" class="text-center">Không có dữ liệu</td>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="text-right" v-if="searchResult.length == 0 && name.length == 0">{{ $genres->render('admin.genres.pagination ') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/alertifyjs/alertify.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/genre.js') }}"></script>
@endsection