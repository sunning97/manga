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
            ['f_name' => 'Hoàng','l_name' => 'Nam','birth_date'=>'1997-11-11','email'=>'hoangnguyen@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'MALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','phone'=>'0971381894','avatar' => 'default.png','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['f_name' => 'Nguyễn','l_name' => 'Hùng','birth_date'=>'1997-11-11','email'=>'nguyenhung@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'MALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','phone'=>'0971381894','avatar' => 'default.png','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['f_name' => 'Tấn','l_name' => 'Tài','birth_date'=>'1997-11-11','email'=>'tantai@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'MALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','phone'=>'0971381894','avatar' => 'default.png','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
        ]);
    }
}
