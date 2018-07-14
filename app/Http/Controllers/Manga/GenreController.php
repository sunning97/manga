<?php

namespace App\Http\Controllers\Manga;

use App\Models\Genre;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-genres')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền xem thể loại']);
        $genres = Genre::paginate(10);
        if (preg_match('/\=\b/',url()->full()))
            $page = explode('=',url()->full())[1];
        else
            $page = 1;
        return view('admin.genres.index')->withGenres($genres)->withPage($page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-genres')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền thêm mới thể loại']);
        return view('admin.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->only(['name','slug_name','description']);
        $notice = Validator::make($all,[
            'name' =>'required|min:2',
            'description' => 'required|min:2'
        ],[
            'name.required' =>'Tên thể loại không được để trống!',
            'name.min' =>'Tên thể loại phải có ít nhất 2 kí tự!',
            'description.required' =>'Mô tả không được để trống!',
            'description.min' =>'Mô tả phải có ít nhất 2 kí tự!',
        ]);

        if($notice->fails()) return redirect()->back()->with('data',$all)->withErrors($notice);

        $genre = Genre::create($all);

        return redirect()->route('genres.index')->withSuccess(['mess' =>'Thêm mới thể loại '.$genre->name.' thành công!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('update-genres')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền cập nhật thể loại']);
        $gener = Genre::find($id);
        return view('admin.genres.edit')->withGenre($gener);
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
        $all = $request->only(['name','slug_name','description']);
        $notice = Validator::make($all,[
            'name' =>'required|min:2',
            'description' => 'required|min:2'
        ],[
            'name.required' =>'Tên thể loại không được để trống!',
            'name.min' =>'Tên thể loại phải có ít nhất 2 kí tự!',
            'description.required' =>'Mô tả không được để trống!',
            'description.min' =>'Mô tả phải có ít nhất 2 kí tự!',
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $genre = Genre::find($id);
        $genre->update($all);

        return redirect()->route('genres.index')->withSuccess(['mess' =>'Cập nhật thể loại '.$genre->name.' thành công!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if($genre){
            $genre->delete();
            return response($genre->name,200);
        } else {
            return response('error',404);
        }
    }
}
