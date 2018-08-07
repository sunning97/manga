@extends('site.layout.app')

@section('title',$manga->name)
@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('content')
    <div class="col-md-8  col-lg-9  container--list">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Truyện</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $manga->name }}</li>
            </ol>
        </nav>
        <div class="row">
            <h3 class="text-center"><b>{{ $manga->name }}</b></h3>
            <div class="row text-center">
                <img src="{{ asset('uploads/manga-covers/'.$manga->cover) }}" alt="{{ $manga->name }}"
                     class="img-responsive">
            </div>
            <hr>
            <div class="row mt-5">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><b>Sơ lược</b></div>
                    <div class="panel-body">{{ $manga->description }}</div>
                </div>
            </div>
            <div class="row mt-5">
                <p><b>Tên khác: <span class="text-danger">{{ $manga->other_name }}</span></b></p>
                <p>
                    <b class="ml-2">Tác giả: </b>
                    @for($i = 0; $i< count($manga->authors);$i++)
                        @if($i == count($manga->authors)-1)
                            <span class="bg-@random">{{ $manga->authors[$i]->name }}</span>
                        @else
                            <span class="bg-@random">{{ $manga->authors[$i]->name }}</span>
                        @endif
                    @endfor
                </p>
                <p>
                    <b class="ml-2">Nhóm dịch: </b>
                    @for($i = 0; $i< count($manga->teams);$i++)
                        @if($i == count($manga->teams)-1)
                            <span class="bg-@random">{{ $manga->teams[$i]->name }}</span>
                        @else
                            <span class="bg-@random">{{ $manga->teams[$i]->name }}</span> <b>|</b>
                        @endif
                    @endfor
                </p>
                <p>
                    <b class="ml-5">Thể loại: </b>
                    @for($i = 0; $i< count($manga->genres);$i++)
                        @if($i == count($manga->genres)-1)
                            <span class="bg-@random">{{ $manga->genres[$i]->name }}</span>
                        @else
                            <span class="bg-@random">{{ $manga->genres[$i]->name }}</span> <b>|</b>
                        @endif
                    @endfor
                </p>
                <p><b>Đăng bởi <span style="color: red">{{ $manga->postBy->f_name." ".$manga->postBy->l_name }}</span>
                        Trạng thái <span style="color: red">{{ $manga->getState($manga->id) }}</span></b></p>
                <p><b>Tham gia update:
                        @if($manga->admins()->first())
                            @for($i = 0;$i< count($manga->admins);$i++)
                                @if($i == (count($manga->admins)-1))
                                    <b>{{ $manga->admins[$i]->f_name.' '.$manga->admins[$i]->l_name }}</b>
                                    @break
                                @endif
                                <b>{{ $manga->admins[$i]->f_name.' '.$manga->admins[$i]->l_name }}</b><b> , </b>
                            @endfor
                        @else
                            <span>Không có ai</span>
                        @endif
                    </b>
                </p>
                <p><b>Update: <span class="text-primary">{{ $manga->updated_at->format('d-m-Y , H:i') }}</span></b></p>
            </div>
            <div class="row mt-5">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5><b>Tổng hợp ( {{ $manga->chaps()->count() }} Chương )</b></h5></div>
                    <div class="">
                        <div class="col-12">
                            <table data-toggle="table" data-height="400" data-mobile-responsive="true"
                                   class="table-striped">
                                <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Ngày đăng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @forelse($manga->chaps as $chap)
                                    <tr id="tr-id-{{ $i }}" class="tr-class-{{ $i }}">
                                        <td>
                                            <b><a href="{{ route('home.manga.chap',[$manga->slug_name,$chap->slug_name,$chap->id]) }}">{{ $chap->name }}</a></b>
                                        </td>
                                        <td>
                                            {{ $chap->created_at->format('d-m-Y , H:i') }}
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
            <div class="row mt-5" id="app">
                <comment></comment>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-table/dist/bootstrap-table.ints.js') }}"></script>
    <script src="{{ asset('assets/site/js/jquery.slimscroll.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/manga-detail.js') }}"></script>
@endsection