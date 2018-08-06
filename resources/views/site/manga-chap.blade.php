@extends('site.layout.app')

@section('title',$chap->name)

@section('content')
    <div class="col-md-8  col-lg-9  container--list">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Truyện</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home.manga',$chap->manga->id) }}">{{ $chap->manga->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $chap->name }}</li>
            </ol>
        </nav>
        <div class="row">
            @foreach($chap->images as $image)
                <div class="row mt-5">
                    <img src="{{ asset('uploads/chap-images/'.$image->image) }}" alt="" class="img-responsive">
                </div>
            @endforeach
            <hr>
        </div>
    </div>
@endsection