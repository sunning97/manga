<?php

use Illuminate\Database\Seeder;

class cource_subject extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        DB::table('subject_cource')->insert([
            ['subject_id' => '1','cource_id' => '1','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['subject_id' => '1','cource_id' => '2','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['subject_id' => '2','cource_id' => '2','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['subject_id' => '5','cource_id' => '3','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['subject_id' => '3','cource_id' => '4','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['subject_id' => '4','cource_id' => '4','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ['subject_id' => '7','cource_id' => '3','created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()]
        ]);
    }
}
