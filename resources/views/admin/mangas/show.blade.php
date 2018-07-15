@extends('admin.layouts.app')

@section('title',$manga->name)

@section('plugin_css')
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
                                        @if($manga->state =='IN_PROCESS')
                                            <b class="text-danger">Đang tiến hành</b>
                                        @elseif($manga->state =='COMPLETE')
                                            <b class="text-success">Hoàn thành</b>
                                        @elseif($manga->state =='HIDDEN')
                                            <b class="text-dark">Ẩn</b>
                                        @endif
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
                        <h4 class="text-left mt-5"><b>Tất Cả Các Chap: {{ $manga->name }}</b> <a href="{{ route('manga.chap.create',$manga->id) }}" class="btn btn-success btn-sm waves-effect ml-5">Thêm chap</a></h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
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
        </div>
    </div>
@endsection

@section('plugin_js')
@endsection

@section('custom_js')
@endsection