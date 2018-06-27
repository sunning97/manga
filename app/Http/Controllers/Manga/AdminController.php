<?php

namespace App\Http\Controllers\Manga;

use App\District;
use App\Models\Admin;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasPermission('read-admins')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền xem quản trị viên']);
        $admins = Admin::where('id', '!=', Auth::user()->id)->paginate(10);
        return view('admin.admins.index')->withAdmins($admins);
    }

    public function profile()
    {
        return view('admin.auth.profile')->withAdmin(Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->hasPermission('read-admins')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền xem quản trị viên']);
        if ($id == Auth::user()->id) return redirect()->route('admin.profile');
        $admin = Admin::find($id);

        return view('admin.admins.show')->withAdmin($admin);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermisson('edit-admins')) return redirect()->back()->withErrors(['mess' => 'Bạn không có quyền cập nhật quản trị viên']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //if(!Auth::user()->hasPermission('update-admins')) return redirect()->back()->withErrors(['mess' =>'Bạn không có quyền cập nhật Admin']);

    }

    public function updateProfile(Request $request)
    {

        $all = $request->only(['f_name', 'l_name', 'email', 'phone', 'gender', 'birth_date']);
        $notice = Validator::make($all, [
            'f_name' => 'required|min:2',
            'l_name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required',
            'birth_date' => 'required'
        ], [
            'f_name.required' => 'Họ không được để trống!',
            'f_name.min' => 'Họ không được ít hơn 2 kí tự!',
            'l_name.required' => 'Tên không được để trống!',
            'l_name.min' => 'Tên không được ít hơn 2 kí tự!',
            'email.required' => 'Email không được để trống!',
            'email.email' => 'Email không đúng định dạng!',
            'phone.required' => 'Số điện thoại không được để trống!',
            'birth_date.required' => 'Ngày/tháng/năm sinh không được để trống'
        ]);
        if ($notice->fails()) return redirect()->back()->withErrors($notice);

        if ($request->province) {
            $address = $request->street . ', ' . Ward::find($request->ward)->type . ' ' . Ward::find($request->ward)->name . ', ' . District::find($request->district)->type . ' ' . District::find($request->district)->name . ', ' . Province::find($request->province)->type . ' ' . Province::find($request->province)->name;

            $all = collect($all);

            $all = $all->except(['province', 'ward', 'district', 'street']);

            $all['address'] = $address;

            $all['birth_date'] = date('Y-m-d', strtotime($all['birth_date']));
            Auth::user()->update($all->toArray());

            return redirect()->route('admin.profile')->withSuccess(['mess' => 'Cập nhật thông tin cá nhân thành công!']);
        } else {
            $all['birth_date'] = date('Y-m-d', strtotime($all['birth_date']));

            Auth::user()->update($all);

            return redirect()->route('admin.profile')->withSuccess(['mess' => 'Cập nhật thông tin cá nhân thành công!']);
        }
    }

    public function updateAvatar(Request $request)
    {
        if ($image = $request->file('avatar')) {

            $avatar_name = str_slug(Auth::user()->f_name . ' ' . Auth::user()->l_name) . '-' . time() . '.' . $image->getClientOriginalExtension();

            if ($image->move(public_path('uploads/admins-avatar'), $avatar_name)) {
                File::delete(public_path('uploads/admins-avatar/' . Auth::user()->avatar));
                Auth::user()->update(['avatar' => $avatar_name]);
                return redirect()->route('admin.profile')->withSuccess(['mess' => 'Cập nhật ảnh đại diện thành công!']);
            }
        }
    }

    public function updatePassword(Request $request)
    {
        $all = $request->only(['curr_password', 'password']);
        if (Hash::check($all['curr_password'], Auth::user()->password)) {
            Auth::user()->update(['password' => Hash::make($all['password'])]);
            return redirect()->route('admin.profile')->withSuccess(['mess' => 'Thay đổi mật khẩu thành công']);
        } else {
            return redirect()->back()->withErrors(['mess' => 'Mật khẩu hiện tại không đúng']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
