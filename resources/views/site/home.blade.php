@extends('site.layout.app')

@section('content')
    <div class="col-md-8  col-lg-9  container--list">
        @foreach($mangas as $manga)
            <div class="post  post--list">
            <div class="row">
                <div class="col-sm-6  col-md-6  post__image">
                    <a href="single-post.html"><img src="{{ asset('uploads/manga-covers/'.$manga->cover) }}" alt="Very Kind and Beautiful Cat"></a>
                </div>
                <div class="col-sm-6  col-md-6  post__list-content">
                    <div class="post__info  post__info--date">
                        <span>{{ $manga->updated_at->format('d-m-Y , H:i') }}</span>
                        <span><a href="#">Lifestyle</a></span>
                    </div>
                    <div class="post__title">
                        <h2><a href="{{ route('home.manga',$manga->id) }}">{{ $manga->name }}</a></h2>
                    </div>
                    <div class="post__content">
                        <p>{!! $manga->description !!}</p>
                    </div>
                    <div class="post__content-more-link">
                        <a href="{{ route('home.manga',$manga->id) }}">Đọc tiếp...</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <nav class="col-md-12  blog-pagination">
            <ul class="blog-pagination__items">
                <li class="blog-pagination__item  blog-pagination__item--active">
                    <a>1</a>
                </li>
                <li class="blog-pagination__item">
                    <a href="#">2</a>
                </li>
                <li class="blog-pagination__item">
                    <a href="#">Next Page</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection