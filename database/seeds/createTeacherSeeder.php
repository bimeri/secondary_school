<?php

use App\Teacher;
use Illuminate\Database\Seeder;

class createTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $teachers = [
            [
                'first_name' => 'Bimeri',
                'last_name' => 'Noel',
                'email' => 'bimerinoel@gmail.com',
                'password' => bcrypt('Magaza@890'),
            ]
        ];
        foreach($teachers as $teacher){
            Teacher::create($teacher);
        }
    }
}
