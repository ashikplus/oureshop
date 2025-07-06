<?php

use Illuminate\Database\Seeder;
// use DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
        	['id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'9800000','email'=>'admin@admin.com','password'=>'$2y$10$2PU1R9.jU0UJsO85H4IYHeaSjBW8WiARvR7pA.JWvwNRjQgmDY7gC','image'=>'','status'=>1],
            ['id'=>2,'name'=>'amir','type'=>'subadmin','mobile'=>'9800000','email'=>'amir@admin.com','password'=>'$2y$10$2PU1R9.jU0UJsO85H4IYHeaSjBW8WiARvR7pA.JWvwNRjQgmDY7gC','image'=>'','status'=>1],
            ['id'=>3,'name'=>'alamin','type'=>'subadmin','mobile'=>'9800000','email'=>'alamin@admin.com','password'=>'$2y$10$2PU1R9.jU0UJsO85H4IYHeaSjBW8WiARvR7pA.JWvwNRjQgmDY7gC','image'=>'','status'=>1],
            ['id'=>4,'name'=>'ashik','type'=>'admin','mobile'=>'9800000','email'=>'ashik@admin.com','password'=>'$2y$10$2PU1R9.jU0UJsO85H4IYHeaSjBW8WiARvR7pA.JWvwNRjQgmDY7gC','image'=>'','status'=>1],
        ];
        foreach($adminRecords as $key => $record){
        	\App\Admin::create($record);
        }
    }
}
