<?php

use Illuminate\Database\Seeder;

class AdminRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();
        DB::table('admin_role')->insert([
            ['admin_id'=>'1','role_id'=>'1'],
            ['admin_id'=>'2','role_id'=>'2'],
            ['admin_id'=>'3','role_id'=>'3']
        ]);
    }
}
