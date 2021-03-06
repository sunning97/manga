<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Chap;
use App\Models\Manga;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MangaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkPermission('read-mangas'))
            return $this->returnError(['mess'=>'Bạn không có quyền xem Manga']);

        $mangas = Manga::paginate(10);
        return view('admin.mangas.index')->withMangas($mangas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkPermission('create-mangas'))
            return $this->returnError(['mess'=>'Bạn không có quyền thêm mới Manga']);

        return view('admin.mangas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->only(['name','other_name','slug_name','description','origin','authors','genres','cover','teams']);
        $notice = Validator::make($all,[
            'name' =>'required|min:5',
            'other_name' =>'required|min:10',
            'description' =>'required|min:10',
            'origin' =>'required',
        ],[
            'name.required' =>'Tiêu đề không được để trống',
            'name.min' =>'Tiêu đề không được ít hơn 5 kí tự',
            'other_name.required' =>'Tên khác không được để trống',
            'other_name.min' =>'Tên khác không được ít hơn 10 kí tự',
            'description.required' =>'Mô tả không được để trống',
            'description.min' =>'Mô tả không được ít hơn 10 kí tự',
            'origin.required' =>'Nguồn truyện không được để trống',
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $all = collect($all);
        if($all->get('authors')){
            if($all->get('genres')){
                if($all->get('teams')){
                    $authors = $all->get('authors');
                    $genres = $all->get('genres');
                    $teams = $all->get('teams');
                    $all = $all->except(['authors','genres']);
                    $all = $all->toArray();
                    if($image = $request->file('cover')){
                        $new_name = $all['slug_name'].'-'.time().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path('uploads/manga-covers'),$new_name);
                        $all['cover'] = $new_name;
                        $all['state'] = 'IN_PROCESS';
                        $all['post_by'] = Auth::user()->id;
                        $all['view'] = 0;

                        $manga = Manga::create($all);

                        foreach ($authors as $author){
                            DB::table('manga_author')->insert([
                                ['manga_id' => $manga->id,'author_id' => $author]
                            ]);
                        }

                        foreach ($teams as $team){
                            DB::table('manga_translate_team')->insert([
                                ['manga_id' => $manga->id,'team_id' => $team]
                            ]);
                        }
                        foreach ($genres as $genre){
                            DB::table('manga_genre')->insert([
                                ['manga_id' => $manga->id,'genre_id' => $genre]
                            ]);
                        }
                        return redirect()->route('mangas.index')->withSuccess(['mess'=>'Thêm mới Truyện '.$manga->name.' thành công']);
                    } else {
                        return redirect()->back()->withErrors(['mess'=>'Ảnh bìa không được để trống']);
                    }
                } else {
                    return redirect()->back()->withErrors(['mess'=>'Nhóm dịch không được để trống']);
                }
            } else {
                return redirect()->back()->withErrors(['mess'=>'Thể loại không được để trống']);
            }
        } else {
            return redirect()->back()->withErrors(['mess'=>'Tác giả không được để trống']);
        }
    }

    public function createChap($id){
        $manga = Manga::find($id);
        return view('admin.mangas.create-chap')->withManga($manga);
    }


    public function storeChap(Request $request,$id){
        $manga = Manga::find($id)->first();
        $all = $request->only(['name','slug_name']);

        $notice = Validator::make($all,[
            'name' => 'required|min:5'
        ],[
            'name.required' =>'Tên chap không được để trống',
            'name.min' =>'Tên chap không được ít hơn 5 kí tự'
        ]);

        if($notice->fails()) return $this->returnError($notice,$all);

        $all['post_by'] = Auth::user()->id;
        $all['manga_id'] = $id;

        $chap = Chap::create($all);

        $m = DB::table('manga_admin')->where([
            ['manga_id','=',$id],
            ['admin_id','=',Auth::user()->id]
        ])->exists();

        if(!$m){
            DB::table('manga_admin')->insert(
                ['manga_id'=>$id,'admin_id'=>Auth::user()->id]
            );
            $manga->updated_at = Carbon::now()->toDateTimeString();
            $manga->save();
        }

        return redirect()->route('mangas.show',$id)->withSuccess(['mess' =>'Thêm mới chap '.$chap->name.' thành công']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->checkPermission('read-mangas'))
            return $this->returnError(['mess'=>'Bạn không có quyền xem Manga này']);

        $manga = Manga::find($id);
        $chaps = $manga->chaps()->paginate(10);
        $poster = Admin::find($manga->post_by);
        $editors = $manga->admins;
        $genres = $manga->genres;
        
        return view('admin.mangas.show')->withManga($manga)->withChaps($chaps)->withPoster($poster)->withEditors($editors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkPermission('update-mangas'))
            return $this->returnError(['mess'=>'Bạn không có quyền cập nhật Manga này']);

        $manga = Manga::find($id);
        return view('admin.mangas.edit')->withManga($manga);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manga = Manga::find($id);
        $all = $request->only(['name','other_name','slug_name','description','origin','authors','genres','teams']);
        $notice = Validator::make($all,[
            'name' =>'required|min:5',
            'other_name' =>'required|min:10',
            'description' =>'required|min:10',
            'origin' =>'required',
        ],[
            'name.required' =>'Tiêu đề không được để trống',
            'name.min' =>'Tiêu đề không được ít hơn 5 kí tự',
            'other_name.required' =>'Tên khác không được để trống',
            'other_name.min' =>'Tên khác không được í hơn 10 kí tự',
            'description.required' =>'Mô tả không được để trống',
            'description.min' =>'Mô tả không được ít hơn 10 kí tự',
            'origin.required' =>'Nguồn truyện không được để trống',
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $all = collect($all);
        if($all->get('authors') && $all->get('genres') && $all->get('teams')){
            $authors = $all->get('authors');
            $genres = $all->get('genres');
            $teams = $all->get('teams');

            $all = $all->except(['authors','genres','teams']);
            $all = $all->toArray();

            if($request->file('cover')){
                $image = $request->file('cover');
                $new_name = $all['slug_name'].'-'.time().'.'.$image->getClientOriginalExtension();
                $all['cover'] = $new_name;
                $image->move(public_path('uploads/manga-covers'),$new_name);
                File::delete(public_path('uploads/manga-covers/'.$manga->cover));
            }

            DB::table('manga_author')->where('manga_id',$id)->delete();
            DB::table('manga_genre')->where('manga_id',$id)->delete();
            Db::table('manga_translate_team')->where('manga_id',$id)->delete();

            foreach ($authors as $author){
                DB::table('manga_author')->insert([
                    ['manga_id' => $manga->id,'author_id' => $author]
                ]);
            }

            foreach ($genres as $genre){
                DB::table('manga_genre')->insert([
                    ['manga_id' => $manga->id,'genre_id' => $genre]
                ]);
            }

            foreach ($teams as $team){
                DB::table('manga_translate_team')->insert([
                    ['manga_id' => $manga->id,'team_id' => $team]
                ]);
            }

            $m = DB::table('manga_admin')->where([
                ['manga_id','=',$manga->id],
                ['admin_id','=',Auth::user()->id]
            ])->exists();

            if(!$m){
                DB::table('manga_admin')->insert(
                    ['manga_id'=>$manga->id,'admin_id'=>Auth::user()->id]
                );
            }

            $manga->update($all);

            return redirect()->route('mangas.show',$manga->id)->withSuccess(['mess'=>'Cập nhật Mnaga '.$manga->name.' thành công!']);
        } else {
            return redirect()->back()->withErrors(['mess'=>'Thể loại / tác giả / nhóm dịch không được để trống!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
