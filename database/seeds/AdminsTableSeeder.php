<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
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

        DB::table('admins')->insert([
            ['f_name' => 'Giang','l_name' => 'Nguyễn','birth_date'=>'1997-04-15','email'=>'mrcatbro97@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'MALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','phone'=>'0971381894','avatar' => 'default.png','state'=>'ACTIVE','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['f_name' => 'Võ','l_name' => 'Phương','birth_date'=>'1997-02-10','email'=>'vophuong@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'FEMALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','phone'=>'0912345333','avatar' => 'default.png','state'=>'ACTIVE','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['f_name' => 'Lã','l_name' => 'Thảo','birth_date'=>'1997-04-14','email'=>'thaothao@gmail.com','password'=>'$2y$10$fzusuAu4DaxeUWkijsdj9.fnBMe3Bj69CHnZnTcAKbLZ5438JKtyC','gender'=>'FEMALE','address'=>'131/10 TCH 18, Phường Tân Chánh Hiệp,Quận 12, TP.Hồ Chí Minh','phone'=>'0912345111','avatar' => 'default.png','state'=>'ACTIVE','created_at'=> $mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()]
        ]);
    }
}
