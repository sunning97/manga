<?php

namespace App\Http\Controllers\Admin;

use App\Models\TranslateTeam;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TranslateTeamController extends Controller
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
        if(!$this->checkPermission('read-teams'))
            return $this->returnError(['mess'=>'Bạn không có quyền xem danh sách nhóm dịch']);

        $teams = TranslateTeam::paginate(10);
        return view('admin.teams.index')->withTeams($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkPermission('create-teams'))
            return $this->returnError(['mess' => 'Bạn không có quyền thêm mới nhóm dịch']);
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request-> only(['name','slug_name','description','leader']);

        $notice = Validator::make($all,[
            'name' => 'required|min:5',
            'description' => 'required|min:5'
        ],[
            'name.required' =>'Tên nhóm dich không được để trống',
            'name.min' => 'Tên không được ít hơn 5 kí tự',
            'description.required' => 'Mô tả không được để trống',
            'description.min' => 'Mô tả không được ít hơn 5 kí tự'
        ]);

        if($notice->fails()) return redirect()->back()->with('data',$all)->withErrors($notice);

        if($request->leader == 'Không có'){
            $all['leader_id'] = null;
        } else {
            $all['leader_id'] = $request->leader;

        }

        if($request->isUseDefault) $all['avatar'] = 'team-avatar-default.png';
        else{
            $image = $request->file('avatar');
            $new_name = $all['slug_name'].'-'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/team-avatars'),$new_name);
            $all['avatar'] = $new_name;
        }
        $team = TranslateTeam::create($all);

        if($team) return redirect()->route('translate-teams.index')->withSuccess(['mess'=>'Thêm mới nhóm dịch '.$team->name.' thành công']);
        else return redirect()->back()->withErrors(['Có lỗi reong quá trinh xử lý']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->checkPermission('read-teams'))
            return $this->returnError(['mess'=>'Bạn không có quyền xem nhóm dịch']);
        $team = TranslateTeam::find($id);
        return view('admin.teams.show')->withTeam($team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkPermission('update-teams'))
            return $this->returnError(['mess'=>'Bạn không có quyền cập nhật nhóm dịch']);
        $team = TranslateTeam::find($id);
        return view('admin.teams.edit')->withTeam($team);
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
        $team = TranslateTeam::find($id);

        $all = $request-> only(['name','slug_name','description','state']);

        $notice = Validator::make($all,[
            'name' => 'required|min:5',
            'description' => 'required|min:5'
        ],[
            'name.required' =>'Tên nhóm dich không được để trống',
            'name.min' => 'Tên không được ít hơn 5 kí tự',
            'description.required' => 'Mô tả không được để trống',
            'description.min' => 'Mô tả không được ít hơn 5 kí tự'
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        if($request->isChangeAvatar){
            $image = $request->file('avatar');
            $new_name = $all['slug_name'].'-'.time().'.'.$image->getClientOriginalExtension();
            if($team->avatar != 'team-avatar-default.png') {
                File::delete(public_path('uploads/team-avatars' . $team->avatar));
            }

            $image->move(public_path('uploads/team-avatars'),$new_name);

            $all['avatar'] = $new_name;
        }

        $team->update($all);

        return redirect()->route('translate-teams.show',$team->id)->withSuccess(['mess' => 'Cập nhật nhóm dịch '.$team->name.' thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = TranslateTeam::find($id);
        if($team)
        {
            $team->delete();
            return response()->json($team->name,200);
        } else {
            return response('error',401);
        }
    }
}
