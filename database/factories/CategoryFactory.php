<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category'=>$this -> faker->randomElement(['Computer', 'Book', 'Tabel', 'Chair', 'Printer', 'LED', 'Laptop']),
        ];
    }
}
