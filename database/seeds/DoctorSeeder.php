<?php

use App\Doctor;
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
        Doctor::create([
            'name'          => 'Hariyadi',
            'gender'        => 'Laki-laki',
            'phone'         => '082119880123',
            'address'       => 'Tasikmalaya',
            'specialist'    => 'Gigi',
            'status'        => 'Tersedia',
            'photo'         => 'default.jpg',
        ]);
    }
}
