<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        DB::table('roles')->insert([
            ['name'=>'Super Administrator','slug_name'=>'super-administrator','description'=>'Là người điều hành, có quyền cao nhất','level'=>'1','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Administrator','slug_name'=>'administrator','description'=>'Là người điều hành, quyền hành ít hơn và bị kiểm soát bởi Super Administrator','level'=>'2','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name'=>'Content Creator','slug_name'=>'content-creator','description'=>'Có vai trò đăng bài mới hoặc chỉnh sửa thông tin bài đăng cũ, có quyền hành ít hơn và bị kiểm soát bởi Super Administrator và Administrator','level'=>'3','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()]
        ]);
    }
}
