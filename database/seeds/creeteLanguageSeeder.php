<?php

use App\Language;
use Illuminate\Database\Seeder;

class creeteLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $languages = [
            [
                'locale' => 'en',
                'active' => '1'
            ],
            [
                'locale' => 'fr',
                'active' => '0'
            ],
        ];
        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
