<?php

use App\Student;
use Illuminate\Database\Seeder;

class CreateStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $students = [
            [
                'first_name' => 'Noel',
                'last_name' => 'Magaza',
                'school_id' => 'FM1A001',
                'email' => 'bimerinoel@gmail.com',
                'password' => bcrypt('Magaza@890'),
                'date_enrolled' => '12/07/2020',
            ]
        ];
        foreach($students as $student){
             Student::create($student);
        }
    }
}
