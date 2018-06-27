<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        // pass: password

        DB::table('users')->insert([
            ['f_name' => 'Hoàng','l_name' => 'Nam','birth_date'=>'1997-11-11','email'=>'hoangnguyen@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'MALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','avatar'=>'user-default.png','phone'=>'0971381894','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()]
        ]);
    }
}
