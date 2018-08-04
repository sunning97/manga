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
            ['name'=>'Xem ACL','slug_name'=>'read-acl','description'=>'Cho phép người dùng xem ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm ACL','slug_name'=>'create-acl','description'=>'Cho phép người dùng thêm mới ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa ACL','slug_name'=>'delete-acl','description'=>'Cho phép người dùng xóa ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật ACL','slug_name'=>'update-acl','description'=>'Cho phép người dùng cập nhật ACL','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Admins','slug_name'=>'read-admins','description'=>'Cho phép người dùng xem Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Admins','slug_name'=>'create-admins','description'=>'Cho phép người dùng thêm mới Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Admins','slug_name'=>'delete-admins','description'=>'Cho phép người dùng xóa Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Admins','slug_name'=>'update-admins','description'=>'Cho phép người dùng cập nhật Admins','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Mangas','slug_name'=>'read-mangas','description'=>'Cho phép người dùng xem Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Mangas','slug_name'=>'create-mangas','description'=>'Cho phép người dùng thêm mới Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Mangas','slug_name'=>'delete-mangas','description'=>'Cho phép người dùng xóa Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Mangas','slug_name'=>'update-mangas','description'=>'Cho phép người dùng cập nhật Mangas','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Chaps','slug_name'=>'read-chaps','description'=>'Cho phép người dùng xem Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Chaps','slug_name'=>'create-chaps','description'=>'Cho phép người dùng thêm mới Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Chaps','slug_name'=>'delete-chaps','description'=>'Cho phép người dùng xóa Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Chaps','slug_name'=>'update-chaps','description'=>'Cho phép người dùng cập nhật Chaps','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Authors','slug_name'=>'read-authors','description'=>'Cho phép người dùng xem tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Authors','slug_name'=>'create-authors','description'=>'Cho phép người dùng thêm mới tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Authors','slug_name'=>'delete-authors','description'=>'Cho phép người dùng xóa tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Authors','slug_name'=>'update-authors','description'=>'Cho phép người dùng cập nhật tác giả','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Genres','slug_name'=>'read-genres','description'=>'Cho phép người dùng xem thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Genres','slug_name'=>'create-genres','description'=>'Cho phép người dùng thêm mới thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Genres','slug_name'=>'delete-genres','description'=>'Cho phép người dùng xóa thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Genres','slug_name'=>'update-genres','description'=>'Cho phép người dùng cập nhật thể loại','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Teams','slug_name'=>'read-teams','description'=>'Cho phép người dùng xem nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Teams','slug_name'=>'create-teams','description'=>'Cho phép người dùng thêm mới nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Teams','slug_name'=>'delete-teams','description'=>'Cho phép người dùng xóa nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Teams','slug_name'=>'update-teams','description'=>'Cho phép người dùng cập nhật nhóm dich','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xem Comments','slug_name'=>'read-comments','description'=>'Cho phép người dùng xem bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Thêm Comments','slug_name'=>'create-comments','description'=>'Cho phép người dùng thêm mới bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Xóa Comments','slug_name'=>'delete-comments','description'=>'Cho phép người dùng xóa bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Cập nhật Comments','slug_name'=>'update-comments','description'=>'Cho phép người dùng cập nhật bình luận','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
        ]);
    }
}
