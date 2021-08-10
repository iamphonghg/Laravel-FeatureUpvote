<?php

namespace Database\Factories;

use App\Models\Contributor;
use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuggestionFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suggestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $status = ['Awaiting', 'Considering', 'Planned', 'Not planned', 'Done', 'Deleted'];
        $randomInteger = rand(0, 5);

        return [
            'contributor_id' => $this->faker->numberBetween(1, 20),
            'title' => ucwords($this->faker->words(4, true)),
            'description' => $this->faker->paragraph(5),
            'status' => $status[$randomInteger],
        ];
    }
}
