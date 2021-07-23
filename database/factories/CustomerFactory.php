<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->name,
            'phone'=>$this->faker->phoneNumber,
            'acc_no'=>$this->faker->bankAccountNumber,
            'ifsc'=>'CNRB0001170',
            'bank'=>'Canara bank',
            'users_id'=>1
        ];
    }
}
