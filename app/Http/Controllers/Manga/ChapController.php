<?php

namespace App\Http\Controllers\Manga;

use App\Models\Chap;
use App\Models\ChapImage;
use App\Models\Manga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-chaps')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền xem Chap']);
        $chaps = Chap::orderBy('id','desc')->paginate(10);
        return view('admin.chaps.index')->withChaps($chaps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-chaps')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền thêm mới Chap']);
        $mangas = Manga::all();
        return view('admin.chaps.create')->withMangas($mangas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->only(['name','slug_name','manga_id']);

        $notice = Validator::make($all,[
            'name' => 'required|min:5'
        ],[
            'name.required' =>'Tên chap không được để trống',
            'name.min' =>'Tên chap không được ít hơn 5 kí tự'
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $all['post_by'] = Auth::user()->id;

        $chap = Chap::create($all);

        return redirect()->route('chaps.show',$chap->id)->withSuccess(['mess' =>'Thêm mới chap '.$chap->name.' thành công']);
    }

    public function image(Request $request,$id){

        if($request->file('file')){
            $chap = Chap::find($id);
            $manga = $chap->manga;
            $order = DB::table('chap_images')
                ->where('chap_id',$id)
                ->max('order');
            if($order == null){
                $order = 0;
            }
            $image = $request->file('file');

            $new_name = $chap->slug_name.'-'.time().rand(111,999).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/chap-images'),$new_name);

            $result = ChapImage::create([
                'chap_id'=> $id,
                'image'=>$new_name,
                'order'=>($order+1)
            ]);

            $m = DB::table('manga_admin')->where([
                ['manga_id','=',$manga->id],
                ['admin_id','=',Auth::user()->id]
            ])->exists();

            if(!$m){
                DB::table('manga_admin')->insert(
                    ['manga_id'=>$manga->id,'admin_id'=>Auth::user()->id]
                );
            }

            $chap->update([
                'update_by' => Auth::user()->id
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chap = Chap::find($id);
        $images = $chap->images;
        return view('admin.chaps.show')->withChap($chap)->withImages($images);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chap = Chap::find($id);
        $mangas = Manga::all();

        return view('admin.chaps.edit')->withChap($chap)->withMangas($mangas);
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
        $all = $request->only(['name','slug_name','manga_id']);

        $notice = Validator::make($all,[
            'name' => 'required|min:5'
        ],[
            'name.required' =>'Tên chap không được để trống',
            'name.min' =>'Tên chap không được ít hơn 5 kí tự'
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $all['update_by'] = Auth::user()->id;

        $chap = Chap::find($id);

        $manga = $chap->manga;

        $m = DB::table('manga_admin')->where([
            ['manga_id','=',$manga->id],
            ['admin_id','=',Auth::user()->id]
        ])->exists();

        if(!$m){
            DB::table('manga_admin')->insert(
                ['manga_id'=>$manga->id,'admin_id'=>Auth::user()->id]
            );
        }

        $chap->update($all);
        return redirect()->route('chaps.show',$chap->id)->withSuccess(['mess' =>'Cập nhật chap '.$chap->name.' thành công']);
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
