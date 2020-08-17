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
                'first_name' => 'John',
                'last_name' => 'Paul',
                'email' => 'paul@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ];
        foreach($teachers as $teacher){
            Teacher::create($teacher);
        }
    }
}
