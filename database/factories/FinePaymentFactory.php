<?php

namespace Database\Factories;

use App\Models\Fine;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinePayment>
 */
class FinePaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id' => Member::inRandomOrder()->first()->id,
            'fine_id' => Fine::inRandomOrder()->first()->id,
            'payment_amount' => 5,
            'payment_date' => $this->faker->date(now()),
        ];
    }
}
