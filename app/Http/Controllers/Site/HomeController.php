<?php

namespace App\Http\Controllers\Site;

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

    public function detailManga($id)
    {
        $manga = Manga::findOrFail($id);
        return view('site.manga-detail')->withManga($manga);
    }
    public function activateUser()
    {

    }
}
