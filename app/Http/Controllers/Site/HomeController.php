<?php

namespace App\Http\Controllers\Site;

use App\Models\Chap;
use App\Models\Manga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $mangas = Manga::orderBy('updated_at','ASC')->paginate(10);
        return view('site.home')->withMangas($mangas);
    }

    public function detailManga($slug,$id)
    {
        $manga = Manga::findOrFail($id);
        return view('site.manga-detail')->withManga($manga);
    }
    public function activateUser()
    {

    }

    public function chapManga($manga,$chap_slug,$id)
    {
        $chap = Chap::findOrFail($id);
        return view('site.manga-chap')->withChap($chap);
    }
}
