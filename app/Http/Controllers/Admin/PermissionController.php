<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-acl')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền xem Permission']);
        $permissions = Permission::paginate(10);
        if (preg_match('/\=\b/',url()->full()))
            $page = explode('=',url()->full())[1];
        else
            $page = 1;
        return view('admin.permissions.index')->withPermissions($permissions)->withPage($page);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-acl')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền thêm mới Permission']);
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->total){
            for($i = 0;$i < $request->total;$i++){
                $tmp = 'put'.$i;
                $str = $request->$tmp;
                $array = explode('|',$str);
                $data = array(
                    'name' => $array[0],
                    'slug_name' => $array[1],
                    'description' => $array[2]
                );
                Permission::create($data);
            }
            return redirect()->route('permissions.index')->withSuccess(['mess' => 'Thêm mới permission thành công!']);
        } else {
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

            $permission = Permission::create($all);

            return redirect()->route('permissions.show',$permission->id)->withSuccess(['mess' => 'Thêm mới permission '.$permission->name.' thành công!']);
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
        if(!Auth::user()->hasPermission('read-acl')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền xem Permission']);
        $permission = Permission::find($id);
        return view('admin.permissions.show')->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('update-acl')) return redirect()->back()->withErrors(['mess'=>'Bạn không có quyền cập nhật Permission']);
        $permission = Permission::find($id);
        return view('admin.permissions.edit')->withPermission($permission);
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
        $all = $request->only(['name','description']);

        $notice = Validator::make($all,[
            'name' => 'required|min:3',
            'description' => 'required|min:5'
        ],[
            'name.required' => 'Tên không được để trống!',
            'name.min' => 'Tên không được ít hơn 3 lí tự!',
            'description.required' =>'Mô tả không được để trống!',
            'description.min' => 'Mô tả không được ít hơn 5 kí tự!'
        ]);

        if($notice->fails()) return redirect()->back()->withErrors($notice);

        $permission = Permission::find($id);
        $permission->update($all);

        return redirect()->route('permissions.index')->withSuccess(['mess' =>'Cập nhật Permission '.$permission->name.' thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if($permission){
            $permission->delete();
            return response()->json($permission->name,'200');
        } else {
            return response('errors','404');
        }
    }
}
