<?php

namespace Database\Seeders;

use App\Models\Contributor;
use App\Models\Suggestion;
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
        Suggestion::factory(30)->create();
    }
}
