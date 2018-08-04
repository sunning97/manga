<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        DB::table('permissions')->insert([
            ['name'=>'Xem ACL','slug_name'=>'read-acl','description'=>'Cho phép xem ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm ACL','slug_name'=>'create-acl','description'=>'Cho phép thêm mới ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa ACL','slug_name'=>'delete-acl','description'=>'Cho phép xóa ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật ACL','slug_name'=>'update-acl','description'=>'Cho phép cập nhật ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Admins','slug_name'=>'read-admins','description'=>'Cho phép xem Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Admins','slug_name'=>'create-admins','description'=>'Cho phép thêm mới Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Admins','slug_name'=>'delete-admins','description'=>'Cho phép xóa Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Admins','slug_name'=>'update-admins','description'=>'Cho phép cập nhật Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Mangas','slug_name'=>'read-mangas','description'=>'Cho phép xem Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Mangas','slug_name'=>'create-mangas','description'=>'Cho phép thêm mới Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Mangas','slug_name'=>'delete-mangas','description'=>'Cho phép xóa Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Mangas','slug_name'=>'update-mangas','description'=>'Cho phép cập nhật Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Chaps','slug_name'=>'read-chaps','description'=>'Cho phép xem Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Chaps','slug_name'=>'create-chaps','description'=>'Cho phép thêm mới Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Chaps','slug_name'=>'delete-chaps','description'=>'Cho phép xóa Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Chaps','slug_name'=>'update-chaps','description'=>'Cho phép cập nhật Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Authors','slug_name'=>'read-authors','description'=>'Cho phép xem tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Authors','slug_name'=>'create-authors','description'=>'Cho phép thêm mới tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Authors','slug_name'=>'delete-authors','description'=>'Cho phép xóa tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Authors','slug_name'=>'update-authors','description'=>'Cho phép cập nhật tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Genres','slug_name'=>'read-genres','description'=>'Cho phép xem thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Genres','slug_name'=>'create-genres','description'=>'Cho phép thêm mới thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Genres','slug_name'=>'delete-genres','description'=>'Cho phép xóa thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Genres','slug_name'=>'update-genres','description'=>'Cho phép cập nhật thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Teams','slug_name'=>'read-teams','description'=>'Cho phép xem nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Teams','slug_name'=>'create-teams','description'=>'Cho phép thêm mới nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Teams','slug_name'=>'delete-teams','description'=>'Cho phép xóa nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Teams','slug_name'=>'update-teams','description'=>'Cho phép cập nhật nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Comments','slug_name'=>'read-comments','description'=>'Cho phép xem bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Comments','slug_name'=>'create-comments','description'=>'Cho phép thêm mới bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Comments','slug_name'=>'delete-comments','description'=>'Cho phép xóa bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Comments','slug_name'=>'update-comments','description'=>'Cho phép cập nhật bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Users','slug_name'=>'read-users','description'=>'Cho phép xem tài khoản người dùng','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Users','slug_name'=>'create-users','description'=>'Cho phép thêm mới tài khoản người dùng','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Users','slug_name'=>'delete-users','description'=>'Cho phép xóa tài khoản người dùng','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Users','slug_name'=>'update-users','description'=>'Cho phép cập nhật tài khoản người dùng','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
        ]);
    }
}
