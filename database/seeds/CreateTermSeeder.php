<?php

use App\Term;
use Illuminate\Database\Seeder;

class CreateTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $terms = [
            [
                'name' => 'First Term',
                'active' => '1'
            ],
            [
                'name' => 'Second Term',
                'active' => '0'
            ],
            [
                'name' => 'Third Term',
                'active' => '0'
            ]
        ];
        foreach($terms as $term){
            Term::create($term);
        }
    }
}
