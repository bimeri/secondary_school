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
                'first_name' => 'Baron',
                'last_name' => 'Noelino',
                'school_id' => 'FM1A001',
                'email' => 'baron.noelino@gmail.com',
                'password' => bcrypt('fm1a001'),
                'date_enrolled' => '12/07/2020',
            ],
            [
                'first_name' => 'Valeri',
                'last_name' => 'Magaza',
                'school_id' => 'FM1A002',
                'email' => 'valeri.magaza@gmail.com',
                'password' => bcrypt('fm1a002'),
                'date_enrolled' => '12/07/2020',
            ]
        ];
        foreach($students as $student){
             Student::create($student);
        }
    }
}
