<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Contributor;
use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $status = ['approved', 'deleted'];
        $randomInteger = rand(0, 1);

        return [
            'contributor_id' => Contributor::factory(),
            'suggestion_id' => Suggestion::factory(),
            'body' => $this->faker->paragraph(3),
            'status' => $status[$randomInteger]
        ];
    }

    public function existing() {
        return $this->state(function (array $attributes) {
            return [
                'contributor_id' => $this->faker->numberBetween(2, 20),
                'status' => 'approved',
            ];
        });
    }
}
