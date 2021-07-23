<?php

namespace Database\Seeders;

use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Customer::factory(5)->create()->each(function (Customer $customer){
           Customer::create([
               'name'=>$customer->name,
               'phone'=>$customer->phone,
               'acc_no'=>$customer->acc_no,
               'ifsc'=>$customer->ifsc,
               'bank'=>$customer->bank,
               'users_id'=>$customer->users_id
           ]);
        });
    }
}
