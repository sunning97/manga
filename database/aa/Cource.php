<?php

use Illuminate\Database\Seeder;

class Cource extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        DB::table('cources')->insert([
            ['name' => 'Khóa 1','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Khóa 2','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Khóa 3','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['name' => 'Khóa 4','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()]
        ]);
    }
}
