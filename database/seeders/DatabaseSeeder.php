<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Contributor;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        Contributor::factory()->create([
            'name' => 'anonymous',
            'email' => 'anonymous@email.com',
            'shop_name' => '@nonymous'
        ]);
        Contributor::factory()->create([
            'name' => 'Phong Hoang Gia',
            'email' => 'gioxoay.xp@gmail.com',
            'shop_name' => '@dmin'
        ]);
        User::factory()->create([
            'name' => 'Phong Hoang Gia',
            'contributor_id' => 2,
            'email' => 'gioxoay.xp@gmail.com',
            'password' => '123123123'
        ]);
        Board::factory()->create([
            'user_id' => 1,
            'board_name' => 'Demo Product',
            'url_name' => 'demoproduct'
        ]);
        Contributor::factory(18)->create();
        Suggestion::factory(20)->create();

        // generate unique votes. Ensure suggestion_id and contributor_id are unique for each row
        foreach (range(2, 20) as $contributor_id) {
            foreach (range(1, 20) as $suggestion_id) {
                if ($suggestion_id % 2 === 0) {
                    Vote::factory()->create([
                        'contributor_id' => $contributor_id,
                        'suggestion_id' => $suggestion_id
                    ]);
                }
            }
        }
    }
}
