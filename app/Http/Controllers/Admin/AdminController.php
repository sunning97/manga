<?php

namespace App\Http\Controllers\Admin;

use App\Classes\ActivationService;
use App\District;
use App\Models\Admin;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $activationService;
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('auth:admin');
        $this->activationService = $activationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->checkPermission('read-admins'))
            return $this->returnError(['mess' => 'Bạn không có quyền xem quản trị viên']);

        $adminsActive = Admin::where('id', '!=', Auth::user()->id)->paginate(10)->where('state','=','ACTIVE');
        $adminsInactive = Admin::where('id', '!=', Auth::user()->id)->paginate(10)->where('state','=','INACTIVE');
        return view('admin.admins.index')->withAdminsActive($adminsActive)->withAdminsInactive($adminsInactive);
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
        if(!$this->checkPermission('create-admins'))
            return $this->returnError(['mess' => 'Bạn không có quyền tạo mới admin!']);
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->only(['f_name','l_name','email','gender','birth_date','province','district','ward','street','password']);
        $data = array(
            'f_name' => $all['f_name'],
            'l_name' => $all['l_name'],
            'email' => $all['email'],
            'gender' => $all['gender'],
            'avatar' => 'default.png'
        );
        if(Admin::where('email',$request->email)->first())
            return redirect()
                    ->back()
                    ->withErrors(['mess'=>'Email đã được sử dụng. vui lòng nhập email khác']);

        if($request->province){
            $ward = Ward::find($all['ward'])->type.' '.Ward::find($all['ward'])->name;
            $district = District::find($all['district'])->type.' '.District::find($all['district'])->name;
            $province = Province::find($all['province'])->type.' '.Province::find($all['province'])->name;
            $address = $all['street'].', '.$ward.', '.$district.', '.$province;
            $data['address'] = $address;
        }
        if($request->password){
            $password = Hash::make($all['password']);
        } else $password = Hash::make('password');

        $data['password'] = $password;

        if($request->birth_date){
            $birth_date = $all['birth_date'];
            $data['birth_date'] = date('Y-m-d',strtotime($birth_date));
        }
        $admin = new Admin();
        foreach ($data as $k => $v){
            $admin->$k = $v;
        }
        $admin->save();

        $this->activationService->sendActivationMail($admin);
        return redirect()
            ->route('admins.index')
            ->withSuccess(['mess'=>'Tạo admin thành công, chờ xác nhận email']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->checkPermission('read-admins'))
            return $this->returnError(['mess' => 'Bạn không có quyền xem quản trị viên']);

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
        if (!$this->checkPermission('update-admins'))
            return $this->returnError(['mess' => 'Bạn không có quyền cập nhật quản trị viên']);
        $admin = Admin::find($id);
        return view('admin.admins.edit')->withAdmin($admin);
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
        if(!$this->checkPermission('update-admins'))
            return $this->returnError(['mess'=>'Bạn không có quyền cập nhật admin']);

        $admin = Admin::find($id);
        if($admin->first()){
            DB::table('admin_role')
                ->where('admin_id','=',$admin->id)
                ->update([
                    'role_id' => $request->role
                ]);
        }

        return redirect()->route('admins.show',$id)->withSuccess(['mess' => "Cập nhật vai trò cho $admin->f_name $admin->l_name thành công"]);
    }

    public function updateProfile(Request $request)
    {

        $all = $request->only(['f_name', 'l_name', 'phone', 'gender', 'birth_date']);
        $notice = Validator::make($all, [
            'f_name' => 'required|min:2',
            'l_name' => 'required|min:2',
            'phone' => 'required',
            'birth_date' => 'required'
        ], [
            'f_name.required' => 'Họ không được để trống!',
            'f_name.min' => 'Họ không được ít hơn 2 kí tự!',
            'l_name.required' => 'Tên không được để trống!',
            'l_name.min' => 'Tên không được ít hơn 2 kí tự!',
            'phone.required' => 'Số điện thoại không được để trống!',
            'birth_date.required' => 'Ngày/tháng/năm sinh không được để trống'
        ]);
        if ($notice->fails()) return redirect()->back()->withErrors($notice);

        if ($request->province) {
            if(!$request->street) return redirect()->back()->withErrors(['mess' => 'Số nhà / tên đường không được để trống!']);

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

            return redirect()
                ->route('admin.profile')
                ->withSuccess(['mess' => 'Cập nhật thông tin cá nhân thành công!']);
        }
    }

    public function updateAvatar(Request $request)
    {
        if ($image = $request->file('avatar')) {

            $avatar_name = str_slug(Auth::user()->f_name . ' ' . Auth::user()->l_name) . '-' . time() . '.' . $image->getClientOriginalExtension();

            if ($image->move(public_path('uploads/admins-avatar'), $avatar_name)) {
                File::delete(public_path('uploads/admins-avatar/' . Auth::user()->avatar));
                Auth::user()->update(['avatar' => $avatar_name]);
                return redirect()
                    ->route('admin.profile')
                    ->withSuccess(['mess' => 'Cập nhật ảnh đại diện thành công!']);
            }
        }
    }

    public function updatePassword(Request $request)
    {
        $all = $request->only(['curr_password', 'password']);
        if (Hash::check($all['curr_password'], Auth::user()->password)) {
            Auth::user()->update(['password' => Hash::make($all['password'])]);
            return redirect()
                ->route('admin.profile')
                ->withSuccess(['mess' => 'Thay đổi mật khẩu thành công']);
        } else {
            return $this->returnError(['mess' => 'Mật khẩu hiện tại không đúng']);
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
