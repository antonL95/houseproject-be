<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'street' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'postcode' => $this->faker->postcode(),
            'client_user_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'menu' => $this->faker->words(),
            'offering' => $this->faker->words(),
            'product_limit' => $this->faker->randomNumber(),
            'condition' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
