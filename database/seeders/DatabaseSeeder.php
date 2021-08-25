<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Comment;
use App\Models\Contributor;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        Contributor::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@secomus.com',
            'shop_name' => 'Admin'
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'contributor_id' => 1,
            'email' => 'admin@secomus.com',
            'password' => Hash::make('123123123')
        ]);
        Board::factory()->create([
            'user_id' => 1,
            'board_name' => 'Demo Product',
            'url_name' => 'demoproduct'
        ]);
        Contributor::factory(19)->create();
        Suggestion::factory(20)->create();

        // generate unique votes. Ensure suggestion_id and contributor_id are unique for each row
        foreach (range(1, 20) as $contributor_id) {
            foreach (range(1, 20) as $suggestion_id) {
                if ($suggestion_id % 2 === 0) {
                    Vote::factory()->create([
                        'contributor_id' => $contributor_id,
                        'suggestion_id' => $suggestion_id
                    ]);
                }
            }
        }

        // generate comments for suggestions

        foreach (Suggestion::all() as $suggestion) {
            Comment::factory(5)->existing()->create(['suggestion_id' => $suggestion->id]);
        }

    }
}
