<?php

namespace Database\Factories;

use App\Models\Customer;
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
            'firstName' => $this->faker->firstName(),
            'lastName'  => $this->faker->lastName(),
            'email'     => $this->faker->safeEmail,
            'phone'     => $this->faker->phoneNumber,
            'password'  => bcrypt(111111),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Customer $customer) {
            //
        })->afterCreating(function (Customer $customer) {
            $customer->addMediaFromUrl(asset('images/avatars/' . $this->faker->numberBetween(1, 10) . '.png'))->toMediaCollection('profile-photo');
        });
    }
}