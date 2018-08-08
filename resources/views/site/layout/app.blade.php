<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from feelman.info/html/leopold/index-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jul 2018 15:18:18 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/site/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <link href="{{ asset('assets/site/css/bootstrap.min.css') }}" rel="stylesheet">
    @yield('plugin_css')
    <link href="{{ asset('assets/site/css/style.min.css') }}" rel="stylesheet">
</head>
<body>
@include('site.layout.svg')
<header class="header">
    <nav class="nav">
        <div class="nav__container  container">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{ route('login') }}">Đăng nhập</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('register') }}">Đăng kí</a>
                </li>
                <li class="nav__item">
                    <a href="contact.html">Danh sách truyện</a>
                </li>
                <li class="nav__item">
                    <a href="contact.html">Lên hệ</a>
                </li>
            </ul>
            <div class="nav__search  search">
                <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"></use>
                </svg>
            </div>
        </div>
    </nav>
    <div class="col-md-12  nav-toggle">
        <svg class="nav-toggle__icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-toggle"></use>
        </svg>
    </div>
    @include('site.layout.header')
</header>
<main>
    <div class="container">
        <div class="row">
            @yield('content')
            <div class="col-md-4  col-lg-3">
                <div class="sidebar-widget">
                    <h3>About Me</h3>
                    <div class="sidebar-widget__about-me">
                        <div class="sidebar-widget__about-me-image">
                            <img src="{{ asset('assets/site/img/about-me.jpg') }}" alt="About Me">
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis commodo ullamcorper.</p>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h3>Follow Me</h3>
                    <div class="sidebar-widget__follow-me">
                        <div class="sidebar-widget__follow-me-icons">
                            <a href="#">
                                <svg>
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use>
                                </svg>
                            </a>
                            <a href="#">
                                <svg>
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use>
                                </svg>
                            </a>
                            <a href="#">
                                <svg>
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-google"></use>
                                </svg>
                            </a>
                            <a href="#">
                                <svg>
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-pinterest"></use>
                                </svg>
                            </a>
                            <a href="#">
                                <svg>
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-instagram"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget__banner">
                        <a href="#"><img src="{{ asset('assets/site/img/banner.jpg') }}" alt="Banner"></a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h3>Popular Posts</h3>
                    <div class="sidebar-widget__popular">
                        <div class="sidebar-widget__popular-item">
                            <div class="sidebar-widget__popular-item-image">
                                <a href="single-post.html"><img src="{{ asset('assets/site/img/sidebar1.jpg') }}" alt="New Flower in the Pot"></a>
                            </div>
                            <div class="sidebar-widget__popular-item-info">
                                <div class="sidebar-widget__popular-item-content">
                                    <a href="single-post.html">New Flower in the Pot</a>
                                </div>
                                <div class="sidebar-widget__popular-item-date">
                                    <span>March 7, 2017</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget__popular-item">
                            <div class="sidebar-widget__popular-item-image">
                                <a href="single-post.html"><img src="{{ asset('assets/site/img/sidebar2.jpg') }}" alt="Easy Walk in the Park"></a>
                            </div>
                            <div class="sidebar-widget__popular-item-info">
                                <div class="sidebar-widget__popular-item-content">
                                    <a href="single-post.html">Easy Walk in the Park</a>
                                </div>
                                <div class="sidebar-widget__popular-item-date">
                                    <span>March 1, 2017</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget__popular-item">
                            <div class="sidebar-widget__popular-item-image">
                                <a href="single-post.html"><img src="{{ asset('assets/site/img/sidebar3.jpg') }}" alt="The Bridge on the River"></a>
                            </div>
                            <div class="sidebar-widget__popular-item-info">
                                <div class="sidebar-widget__popular-item-content">
                                    <a href="single-post.html">The Bridge on the River</a>
                                </div>
                                <div class="sidebar-widget__popular-item-date">
                                    <span>February 10, 2017</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget__popular-item">
                            <div class="sidebar-widget__popular-item-image">
                                <a href="single-post.html"><img src="{{ asset('assets/site/img/sidebar4.jpg') }}" alt="Best Cooking Lessons"></a>
                            </div>
                            <div class="sidebar-widget__popular-item-info">
                                <div class="sidebar-widget__popular-item-content">
                                    <a href="single-post.html">Best Cooking Lessons</a>
                                </div>
                                <div class="sidebar-widget__popular-item-date">
                                    <span>February 16, 2017</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget__popular-item">
                            <div class="sidebar-widget__popular-item-image">
                                <a href="single-post.html"><img src="{{ asset('assets/site/img/sidebar5.jpg') }}" alt="My Favorite Drink"></a>
                            </div>
                            <div class="sidebar-widget__popular-item-info">
                                <div class="sidebar-widget__popular-item-content">
                                    <a href="single-post.html">My Favorite Drink</a>
                                </div>
                                <div class="sidebar-widget__popular-item-date">
                                    <span>February 7, 2017</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h3>Instagram</h3>
                    <div class="sidebar-widget__instagram">
                        <a href="#"><img src="{{ asset('assets/site/img/instagram9.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram8.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram7.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram6.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram5.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram4.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram3.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram2.jpg') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('assets/site/img/instagram1.jpg') }}" alt="Instagram"></a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h3>Tag Cloud</h3>
                    <div class="sidebar-widget__tag-cloud">
                        <a href="#">Travel</a>
                        <a href="#">Music</a>
                        <a href="#">Arts</a>
                        <a href="#">Creative</a>
                        <a href="#">Fashion</a>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h3>Subscribe</h3>
                    <div class="sidebar-widget__subscribe">
                        <p>Follow my latest news</p>
                        <form action="http://feelman.info/html/leopold/index.html">
                            <input type="text" placeholder="Your email">
                            <input class="sidebar-widget__subscribe-submit" type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('site.layout.footer')
<div class="search-popup">
    <svg class="search-popup__close">
        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use>
    </svg>
    <div class="search-popup__container  container">
        <form action="http://feelman.info/html/leopold/index.html">
            <input type="text" size="32" placeholder="Search">
        </form>
    </div>
</div>
<div class="content-overlay"></div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/site/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('assets/site/js/script.js') }}"></script>
<script src="{{ asset('assets/admin/plugin/jquery-date-format/dist/jquery-dateformat.min.js') }}"></script>

@yield('plugin_js')
@yield('custom_js')
</body>

</html>