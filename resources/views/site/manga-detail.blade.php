@extends('site.layout.app')

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
                <img src="{{ asset('uploads/manga-covers/'.$manga->cover) }}" alt="{{ $manga->name }}" class="img-responsive">
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
                <p><b>Đăng bởi <span style="color: red">{{ $manga->postBy->f_name." ".$manga->postBy->l_name }}</span> Trạng thái <span style="color: red">{{ $manga->getState($manga->id) }}</span></b></p>
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
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tên chương</th>
                                                <th class="text-right">Ngày đăng</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div id="slimtest1">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach($manga->chaps as $chap)
                                                <tr>
                                                    <td><b><a href="">{{ $chap->name }}</a></b></td>
                                                    <td class="text-right">{{ $chap->created_at->format('d-m-Y , H:i') }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection