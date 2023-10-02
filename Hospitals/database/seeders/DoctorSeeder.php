<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::factory()->count(30)->create();
        $Appointment = Appointment::all();
        Doctor::all()->each(function ($doctors) use ($Appointment){
                $doctors->doctorappointments()->attach(
                    $Appointment->random(rand(1,7))->pluck('id')->toArray()
                );
        });
    }
}
