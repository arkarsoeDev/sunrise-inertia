<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->userName();
        $date = $this->faker->dateTimeBetween();
        $copies_owned = rand(1, 20);
        return [
            'title' => $title,
            'publication_date' => $date,
            'copies_owned' => $copies_owned,
            'available' => $copies_owned,
        ];
    }
}
