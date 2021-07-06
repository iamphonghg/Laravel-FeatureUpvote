<?php

use Illuminate\Database\Seeder;
use App\Models\Contributor;

class ContributorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contributor1 = new Contributor();
        $contributor1->name = 'e';
        $contributor1->email = 'e@secomus.com';
        $contributor1->shop_name = 'E';
        $contributor1->save();

        $contributor2 = new Contributor();
        $contributor2->name = 'Carl Zide';
        $contributor2->email = 'carlzide@secomus.com';
        $contributor2->shop_name = 'CARL ZIDE';
        $contributor2->save();

        $contributor3 = new Contributor();
        $contributor3->name = 'Tirekicker';
        $contributor3->email = 'tirekicker@secomus.com';
        $contributor3->shop_name = 'TIREKICKER';
        $contributor3->save();

        $contributor4 = new Contributor();
        $contributor4->name = 'Test user';
        $contributor4->email = 'testuser@secomus.com';
        $contributor4->shop_name = 'TESTUSER';
        $contributor4->save();

        $contributor5 = new Contributor();
        $contributor5->name = 'Yousef Al-Mulla';
        $contributor5->email = 'yousefalmulla@secomus.com';
        $contributor5->shop_name = 'YOUSEF AL-MULLA';
        $contributor5->save();
    }
}
