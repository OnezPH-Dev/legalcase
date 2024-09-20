<?php

namespace Database\Factories;

use App\Models\Legal;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Legal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => fake()->name(),
            'company_address' => fake()->address(),
            'case_number' => fake()->randomNumber(),
            'status' => fake()->randomElement(['Decided but no payment', 'Paid fines and penalties', 'Under Litigation / Pending']),
            'legalcasefile' => fake()->title(),
        ];
    }
}
