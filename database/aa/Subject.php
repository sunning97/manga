<?php

use Illuminate\Database\Seeder;

class Subject extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        DB::table('subjects')->insert([
            ['name' => 'Toán','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Văn','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Anh','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Sử','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Địa','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Vật Lý','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Hóa Học','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()]
        ]);
    }
}
