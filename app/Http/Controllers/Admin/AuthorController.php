<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-authors')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền xem tác giả!']);
        $authors = Author::paginate(10);
        return view('admin.authors.index')->withAuthors($authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-authors')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền thêm tác giả!']);
        return view('admin.authors.create');
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
            'name' => 'required|min:3',
            'description' => 'required|min:5'
        ],[
            'name.required' => 'Tên tác giả không được để trống!',
            'name.min' => 'Tên tác giả không được ít hơn 3 kí tự!',
            'description.required' => 'Mô tả không được để trống!',
            'description.min' => 'Mô tả không được ít hơn 5 kí tự!',
        ]);

        if($notice->fails()) return redirect()->back()->with('data',$all)->withErrors($notice);

        $author = Author::create($all);

        return redirect()->route('authors.index')->withSuccess(['mess' => 'Thêm mới tác giả '.$author->name.' thành công!']);
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
        if(!Auth::user()->hasPermission('update-authors')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền cập nhật tác giả']);
        $author = Author::find($id);
        return view('admin.authors.edit')->withAuthor($author);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if($author){
            $author->delete();
            return response($author->name,200);
        } else {
            return response('error',404);
        }
    }
}
