<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            ['id'=>1,'user_id'=>1,'name'=>"Ashikul Islam",'address'=>'address-111','city'=>'Dhaka','state'=>'Dhaka','country'=>'Bangladesh','pincode'=>'111222','mobile'=>'01821174867','status'=>1],
            ['id'=>2,'user_id'=>1,'name'=>"Ashikul Islam",'address'=>'address-222','city'=>'Dhaka','state'=>'Dhaka','country'=>'Bangladesh','pincode'=>'111222','mobile'=>'01821174867','status'=>1]
        ];
        DeliveryAddress::insert($deliveryRecords);
    }
}
