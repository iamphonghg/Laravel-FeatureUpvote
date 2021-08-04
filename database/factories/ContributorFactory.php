<?php

namespace Database\Factories;

use App\Models\Contributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContributorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'shop_name' => $this->faker->company(),
        ];
    }
}
