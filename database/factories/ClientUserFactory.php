<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClientUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClientUserFactory extends Factory
{
    protected $model = ClientUser::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'var_number' => $this->faker->word(),
            'street' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'postcode' => $this->faker->postcode(),
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($this->faker->password()),
            'google_id' => $this->faker->word(),
            'facebook_id' => $this->faker->word(),
            'apple_id' => $this->faker->word(),
            'profile_image' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
