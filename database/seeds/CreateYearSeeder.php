<?php

use App\Year;
use Illuminate\Database\Seeder;

class CreateYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $year = [
            [
                'name' => '2019/2020',
                'active' => '1'
            ],
            [
                'name' => '2020/2021',
                'active' => '0'
            ],
            [
                'name' => '2021/2021',
                'active' => '0'
            ]
        ];
        foreach($year as $ye){
            Year::create($ye);
        }
    }
}
