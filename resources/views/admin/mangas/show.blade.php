@extends('admin.layouts.app')

@section('title',$manga->name)

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $manga->name }}</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('mangas.index') }}">Manga</a></li>
                <li class="active">{{ $manga->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-8">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width: 200px">Tên khác</th>
                                    <td><h4><b>{{ $manga->other_name }}</b></h4></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        {{ $manga->getState($manga->id) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lượt xem</th>
                                    <td><b>{{ $manga->view }}</b></td>
                                </tr>
                                <tr>
                                    <th>Tác giả</th>
                                    <td>
                                        @for($i = 0; $i< count($manga->authors);$i++)
                                            @if($i == count($manga->authors)-1)
                                                <b><span class="text-@random">{{ $manga->authors[$i]->name }}</span></b>
                                            @else
                                                <b><span class="text-@random">{{ $manga->authors[$i]->name }}</span></b> |
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thể loại</th>
                                    <td>
                                        @for($i = 0; $i< count($manga->genres);$i++)
                                            @if($i == count($manga->genres)-1)
                                                <b><span class="text-@random">{{ $manga->genres[$i]->name }}</span></b>
                                            @else
                                                <b><span class="text-@random">{{ $manga->genres[$i]->name }}</span></b> |
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nhóm dịch</th>
                                    <td>
                                        @for($i = 0; $i< count($manga->teams);$i++)
                                            @if($i == count($manga->teams)-1)
                                                <b><span class="text-@random">{{ $manga->teams[$i]->name }}</span></b>
                                            @else
                                                <b><span class="text-@random">{{ $manga->teams[$i]->name }}</span></b> |
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nguồn</th>
                                    <td><b><span class="text-@random">{{ $manga->origin }}</span></b></td>
                                </tr>
                                <tr>
                                    <th>Đăng bởi</th>
                                    <td><b>{{ $poster->f_name .' '.$poster->l_name }}</b></td>
                                </tr>
                                <tr>
                                    <th>Tham gia cập nhật</th>
                                    <td>
                                        @if($editors->all())
                                            @for($i = 0;$i< count($editors);$i++)
                                                @if($i == (count($editors)-1))
                                                    <a href="{{ route('admins.show',$editors[$i]->id) }}"><b>{{ $editors[$i]->f_name.' '.$editors[$i]->l_name }}</b></a>
                                                    @break
                                                @endif
                                                <a href="{{ route('admins.show',$editors[$i]->id) }}"><b>{{ $editors[$i]->f_name.' '.$editors[$i]->l_name }}</b></a><b> , </b>
                                            @endfor
                                        @else
                                            <span>Không có ai</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày đăng</th>
                                    <td>{{ $manga->created_at->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td>{!! $manga->description !!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('uploads/manga-covers/'.$manga->cover) }}" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <h4 class="text-left mt-5"><b>Tất Cả Các Chap: {{ $manga->chaps->count() }} chap</b> <a href="{{ route('admin.chap.create',$manga->id) }}" class="btn btn-success btn-sm waves-effect ml-5">Thêm chap</a></h4>
                    </div>
                </div>
                <div class="col-12">
                    <table data-toggle="table" data-height="500" data-mobile-responsive="true" class="table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Ngày đăng</th>
                            <th>Người đăng</th>
                            <th>Người cập nhật</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @forelse($chaps as $chap)
                            <tr id="tr-id-{{ $i }}" class="tr-class-{{ $i }}">
                                <td id="td-id-{{ $i }}" class="td-class-{{ $i }}">{{ $i }}</td>
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
                            @php($i++)
                        @empty
                            <td colspan="5" class="text-center">Không có dữ liệu</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-table/dist/bootstrap-table.ints.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/manga-show.js') }}"></script>
@endsection