<?php

use App\Setting;
use Illuminate\Database\Seeder;

class CreateSequenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sequences = [
                'year_id' => '1',
                'school_name' => 'Balingual Grammar School',
                'motto' => 'Bonita Disciplina Sianta',
                'logo' => 'lo.jfif',
                'test_session' => '0',
                'exam_session' => '0',
                'start_time' => '08:00',
                'break_time' => '12:00',
                'stop_time' => '17:00'
            ];
            Setting::create($sequences);
    }
}
