<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'role_id' => rand(1, 3),
            'email' => fake()->unique()->safeEmail(),
            'password' => '9f9dd1d2e3f189e7929a73ef1f5b54873622f64cc15210133c5085b5175325df', // secret
            'address' => fake()->address,
            'phone' => fake()->phoneNumber(),
        ];
    }
}
