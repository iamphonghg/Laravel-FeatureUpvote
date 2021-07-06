<?php

use Illuminate\Database\Seeder;
use App\Models\Suggestion;

class SuggestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sgt1 = new Suggestion();
        $sgt1->title = 'Would like a calendar';
        $sgt1->content = 'It takes too long to pick a date with the dropdown';
        $sgt1->contributor_id = 1;
        $sgt1->save();

        $sgt2 = new Suggestion();
        $sgt2->title = 'We need to have multilingual support';
        $sgt2->content = 'We need to have multilingual support. Swedish, English and Finnish';
        $sgt2->contributor_id = 2;
        $sgt2->save();
        
        $sgt3 = new Suggestion();
        $sgt3->title = 'More suggested features';
        $sgt3->content = 'This is supposed to be a demo. Where are the existing feature requests?';
        $sgt3->contributor_id = 3;
        $sgt3->save();

        $sgt4 = new Suggestion();
        $sgt4->title = 'Add Gmail intergration';
        $sgt4->content = 'It would be great if GMail integration was added';
        $sgt4->contributor_id = 4;
        $sgt4->save();

        $sgt5 = new Suggestion();
        $sgt5->title = 'I would like to have this and that in Doha, Qatar';
        $sgt5->content = 'Description for I would like to have this and that in Doha, Qatar';
        $sgt5->contributor_id = 5;
        $sgt5->save();
        
    }
}
