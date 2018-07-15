<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-acl')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền xem Role']);
        $roles = Role::paginate(10);
        return view('admin.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-acl')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền thêm mới Role']);
        return view('admin.roles.create');
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
            'name.required' => 'Tên role không được để trống!',
            'name.min' => 'Tên role không được ít hơn 3 kí tự!',
            'description.required' => 'Mô tả không được để trống!',
            'description.min' => 'Mô tả không được ít hơn 5 kí tự!',
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);
        $all['level'] = (Role::max('level')+1);

        $role = Role::create($all);

        return redirect()->route('roles.show',$role->id)->withSuccess(['mess' => 'Thêm mới role '.$role->name.' thành công!']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('read-acl')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền xem Role']);
        $role = Role::find($id);
        $permissons = $role->permission;
        if($role){
            return view('admin.roles.show')->withRole($role)->withPermissons($permissons);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('update-acl')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền cập nhật Role']);
        $role = Role::find($id);
        $permissions = Permission::all();
        $r_p = $role->permission;

        $others = array();

        for($i = 0; $i < count($permissions);$i++){
            $trung = false;
            for($j = 0; $j < count($r_p);$j++){
                if($permissions[$i]->id == $r_p[$j]->id){
                    $trung = true;
                    break;
                }
            }
            if(!$trung) array_push($others,$permissions[$i]);
        }
        return view('admin.roles.edit')->withRole($role)->withPermissions($permissions)->withOthers($others)->withRp($r_p);
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
            'name' => 'required|min:3',
            'description' => 'required|min:5'
        ],[
            'name.required' => 'Tên role không được để trống!',
            'name.min' => 'Tên role không được ít hơn 3 kí tự!',
            'description.required' => 'Mô tả không được để trống!',
            'description.min' => 'Mô tả không được ít hơn 5 kí tự!',
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $role = Role::find($id);
        $role->update($all);
        return redirect()->route('roles.show',$role->id)->withSuccess(['mess' => 'Cập nhật role '.$role->name.' thành công!']);
    }

    public function update_permission(Request $request,$id){
        $role = Role::find($id);

        DB::table('role_permission')->where('role_id',$role->id)->delete();

        if($request->permissions){
            foreach ($request->permissions as $value){
                DB::table('role_permission')->insert([
                    ['role_id' => $id,'permission_id' => $value]
                ]);
            }
        }
        return redirect()->route('roles.show',$role->id)->withSuccess(['mess'=>'Cập nhật quyền cho role '.$role->name.' thành công']);
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
