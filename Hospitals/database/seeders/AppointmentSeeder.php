<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->delete();
        $Appointments = [
            ['name'=>'الأحد'],
            ['name'=>'الإثنين'],
            ['name'=>'الثلاثاء'],
            ['name'=>'الأربعاء'],
            ['name'=>'الخميس'],
            ['name'=>'الجمعة'],
            ['name'=>'السبت'],
        ];
        foreach($Appointments as $Appointment){
            Appointment::create($Appointment);
        }
    }
}
