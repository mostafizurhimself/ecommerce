<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use App\Enums\AddressType;
use App\Enums\PaymentMethod;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id'    => $this->faker->randomElement(Customer::pluck('id')->toArray()),
            'note'           => $this->faker->sentence(),
            'payment_method' => PaymentMethod::COD(),
        ];
    }


    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Order $order) {
            //
        })->afterCreating(function (Order $order) {
            // Create billing address
            $order->address()->create([
                'type'      => AddressType::BILLING_ADDRESS(),
                'street'    => $this->faker->streetAddress,
                'city'      => $this->faker->city,
                'zipcode'   => $this->faker->postcode,
                'country'   => Country::first()->name,
            ]);

            // Create shipping address
            $order->address()->create([
                'type'      => AddressType::SHIPPING_ADDRESS(),
                'street'    => $this->faker->streetAddress,
                'city'      => $this->faker->city,
                'zipcode'   => $this->faker->postcode,
                'country'   => Country::first()->name,
            ]);
        });
    }
}