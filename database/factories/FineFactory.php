<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fine>
 */
class FineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = date('Y-m-d', $this->faker->unixTime($this->faker->dateTimeBetween()));
        return [
            'member_id' => Member::inRandomOrder()->first()->id,
            'loan_id' => Loan::inRandomOrder()->first()->id,
            'paid' => false,
            'fine_amount' => 5,
            'fine_date' => $date,  
        ];
    }
}
