<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    private $customDate;
    private $ccount = 7;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $base_date = $this->customDate ?? $this->faker->dateTimeBetween('-7 days','-4 days')->getTimestamp();
        $loan_date = date('Y-m-d', $base_date);
        $return_date = date('Y-m-d', strtotime('+7 days', $base_date));

        $define = [
            'book_id' => Book::inRandomOrder()->first()->id,
            'member_id' => Member::inRandomOrder()->first()->id,
            'duration' => 7,
            'loan_date' => $loan_date,
            'return_date' => $return_date,
        ];

        if($this->ccount >= 7) {
            $this->customDate = strtotime('-6 days', strtotime($return_date));
            $this->ccount = 0;
        } else {
            $this->ccount += 1;
        }

        return $define;
    }
}
