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
        $role = [2,3,4,5];


        for($i =1;$i <=50;$i++){
            $role_id = array_random($role);
            DB::table('admin_role')->insert([
                ['admin_id' => $i, 'role_id' => $role_id]
            ]);
        }

        DB::table('admin_role')->insert([
            ['admin_id'=>'51','role_id'=>'1'],
            ['admin_id'=>'52','role_id'=>'2'],
            ['admin_id'=>'33','role_id'=>'3'],
        ]);
    }
}
