<?php

use App\Admin;
use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
               'first_name'=>'Bimeri',
               'last_name'=>'Noel',
               'is_super'=>'1',
               'email'=>'bimerinoel@gmail.com',
               'user_name'=>'bimeri',
               'profile'=>'image/profiles/2.png',
               'gender'=>'male',
               'date_of_birth'=>'12/17/1997',
               'password'=> bcrypt('123456'),
            ],
            [
                'first_name'=>'Second',
               'last_name'=>'Admin',
               'is_super'=>'0',
               'email'=>'example@gmail.com',
               'user_name'=>'second',
               'profile'=>'image/profiles/2.png',
               'gender'=>'male',
               'date_of_birth'=>'01/17/1997',
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            Admin::create($value);
        }

    }
}
