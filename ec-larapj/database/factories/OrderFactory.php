<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds =User::pluck('id')->all();
        return [
            'id' => $this->faker->uuid,
            'user_id'=>$this->faker->randomElement($userIds)
        ];
    }
}
