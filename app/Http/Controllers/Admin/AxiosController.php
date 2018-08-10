<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Chap;
use App\Models\ChapImage;
use App\Models\Genre;
use App\Models\Manga;
use App\Models\Permission;
use App\Models\Role;
use App\Models\TranslateTeam;
use App\Models\User;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;

class AxiosController extends Controller
{
    public function permissions($id){
        $result = Role::find($id)->permission;
        return response()->json($result,'200');
    }

    public function roles()
    {
        $roles = Role::orderBy('level', 'ASC')->get();
        return response()->json($roles,200);
    }

    public function deletePermission($id){
        $permission = Permission::find($id);
        if($permission){
            $result = DB::table('permissions')
                ->where('id',$id)
                ->delete();
            return response()->json($permission->name,'200');
        } else {
            return response()->json($permission->name,'401');
        }
    }

    public function provinces(){
        $provinces = Province::all();
        return response()->json($provinces,'200');
    }

    public function districts($id){
        $districts = District::where('province_id',$id)->get();
        return response()->json($districts,'200');
    }

    public function wards($id){
        $wards = Ward::where('district_id',$id)->get();
        return response()->json($wards,'200');
    }

    public function authors(){
        $authors = Author::all();
        return response()->json($authors,'200');
    }

    public function genres(){
        $genres = Genre::all();
        return response()->json($genres,'200');
    }

    public function mangas(){
        $mangas = Manga::all();
        return response()->json($mangas,'200');
    }

    public function chapImages($id){
        $images = Chap::find($id)->images;
        $images = collect($images);
        $images->sortBy('order');
        return response()->json($images->toArray(),'200');
    }

    public function authorsNotIn($id){
        $manga = Manga::find($id);
        $sql = '';
        foreach ($manga->authors as $author){
            $sql .='id != '.$author->id.' AND ';
        }
        $sql= trim($sql,' AND ');

        $authors = DB::table('authors')->whereRaw($sql)->get();

        return response()->json($authors,'200');
    }

    public function genresNotIn($id){
        $manga = Manga::find($id);
        $sql = '';
        foreach ($manga->genres as $genre){
            $sql .='id != '.$genre->id.' AND ';
        }
        $sql= trim($sql,' AND ');

        $authors = DB::table('genres')->whereRaw($sql)->get();

        return response()->json($authors,'200');
    }

    public function searchGenre(Request $request){
        $name = $request->name;
        $result = DB::table('genres')->where('name','like','%'.$name.'%')->get();
        return response()->json($result,'200');
    }
    public function searchPermission(Request $request){
        $name = $request->name;
        $result = DB::table('permissions')->where('name','like','%'.$name.'%')->orWhere('slug_name','like','%'.str_slug($name).'%')->get();
        return response()->json($result,'200');
    }

    public function chapImageEdit(Request $request){
        if($request->file('image')){
            $image = $request->file('image');
            $chapImage = ChapImage::find($request->id);
            $chap = $chapImage->chap;
            $manga = $chap->manga;
            if($chapImage){
                $new_name = $chapImage->chap->slug_name.'-'.time().rand(111,999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/chap-images'),$new_name);
                File::delete(public_path('uploads/chap-images/'.$chapImage->image));

                $chapImage->image = $new_name;
                $chapImage->save();
                $chap->updated_at = Carbon::now()->toDateTimeString();
                $chap->update_by = Auth::guard('admin')->user()->id;
                $chap->save();
                $manga->updated_at = Carbon::now()->toDateTimeString();
                $manga->save();
                return response()->json($chapImage,200);
            }
        } else {
            return response('error',404);
        }
    }

    public function deleteChapImage($id){
        $image = ChapImage::find($id);
        if($image){
            $chap = $image->chap;
            $manga = $chap->manga;
            $image->delete();

            File::delete(public_path('uploads/chap-images/'.$image->image));

            $chap->updated_at = Carbon::now()->toDateTimeString();
            $chap->update_by = Auth::guard('admin')->user()->id;
            $chap->save();
            $manga->updated_at = Carbon::now()->toDateTimeString();
            $manga->save();
            return response()->json($image->image,'200');
        } else {
            return response()->json('error','401');
        }
    }

    public function users(){
        $users = User::all();
        if($users)
        return response()->json($users,200);
        else return response('',401);
    }
    public function searchTeams(Request $request){
        $name = str_slug($request->name);
        if(strlen($name) == 0) return response('error',404);
        $teams = DB::table('translate_teams')
            ->where('slug_name','like','%'.$name.'%')
            ->get();
        if($teams->toArray()){
            return response()->json($teams,200);
        } else {
            return response('error',404);
        }
    }

    public function teams()
    {
        $teams = TranslateTeam::all();
        return response()->json($teams,200);
    }

    public function teamsNotIn($id)
    {
        $manga = Manga::find($id);
        $sql = '';
        foreach ($manga->teams as $team){
            $sql .='id != '.$team->id.' AND ';
        }
        $sql= trim($sql,' AND ');

        $teams = DB::table('translate_teams')->whereRaw($sql)->get();

        return response()->json($teams,'200');
    }

    public function searchAuthor(Request $request){
        $name = str_slug($request->name);
        $result = DB::table('authors')->where('slug_name','like','%'.$name.'%')->get();

        if($result->all()){
            return response()->json($result,200);
        }else {
            return response('error',404);
        }
    }

    public function getAllContacts(){
        $contacts = Admin::where('id','!=',Auth::guard('admin')->user()->id)->get();
        return response()->json(['contacts' => $contacts,'path' => asset('uploads/admins-avatar')],200);
    }

    public function getConversation(Request $request)
    {
        return response()->json(DB::select(DB::raw('SELECT * FROM `messages` WHERE `sent_from` = '.Auth::guard('admin')->user()->id.' AND `sent_to` = '.$request->contact_id.' OR `sent_from` = '.$request->contact_id.' AND `sent_to` = '.Auth::guard('admin')->user()->id)),200);
    }

    public function getAuthor(Request $request)
    {
        $author = Author::find($request->id)->first();
        if($author){
            return response()->json($author,200);
        }
        return response('',404);
    }

    public function getAdmins(Request $request)
    {
        if($request->state)
        {
            $adminsActive = DB::table('admins')
            ->leftJoin('admin_role','admins.id','=','admin_role.admin_id')
            ->where('admins.id','!=',Auth::guard('admin')->user()->id)
            ->where('admins.state','=',$request->state)
            ->paginate(5);
            return response()->json($adminsActive,200);

        } else return response('error',404);
    }

    public function getRoles()
    {
        $roles = Role::all();
        return response()->json($roles,200);
    }
    public function searchRole(Request $request)
    {
        $slug = str_slug($request->data);
        $roles = DB::table('roles')
            ->where(function ($query) use($request,$slug){
                $query->where('slug_name','like',"%$slug%")
                ->orWhere('level','=',$request->data);
            })->get();
        if($roles->first()){
            return response()->json($roles,200);
        }
        return response('error',404);
    }
    public function searchAdmin(Request $request)
    {
        $result = DB::table('admins')
            ->leftJoin('admin_role','admins.id','=','admin_role.admin_id')
            ->where('admins.id','!=',Auth::guard('admin')->user()->id)
            ->where('admins.state','=',$request->state)
            ->where(function ($query) use ($request){
            $query->where('admins.f_name','like','%'.$request->data.'%')
                ->orWhere('admins.l_name','like','%'.$request->data.'%')
                ->orWhere('admins.email','=',$request->data)
                ->orWhere('admins.phone','=',"'$request->data'");
            })->get();
        if($result->first()){
            return response()->json($result,200);
        } else {
            return response('No sesult',404);
        }
    }

    public function checkEmailAdmin(Request $request)
    {
        $email = $request->only('email');

        if(Admin::where('email',$email)->first()){
            return response('used',200);
        }
        return response('ok',200);
    }

    public function checkPer(Request $request)
    {
        if(Auth::guard('admin')->user()->hasPermission($request->permission)){
            return response()->json('ok',200);
        }
        return response()->json('error',200);
    }

    public function getUsers(Request $request)
    {
        $user = User::where('state','=',$request->state)
            ->paginate(10);

        return response()->json($user,200);
    }

    public function searchUser(Request $request)
    {
        $users = User::where('state','=',$request->state)
                ->where(function ($query) use($request){
                    $query->where('f_name','like',"%$request->data%")
                    ->orWhere('l_name','like',"%$request->data%");
                })->get();

        if($users->first())
            return response()->json($users,200);

        return response('no data',405);
    }
}
