<?php

use App\User;
use App\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Jcc Coding',
            'email'     => 'jcc@coding.com',
            'password'  => bcrypt('jcc2022'),
            'role'      => 1
        ]);

        UserDetail::create([
            'id'            => $user->id,
            'user_number'   => 1,
            'gender'        => 'Laki-laki',
            'blood_group'   => 'B',
            'address'       => 'Bogor',
            'phone'         => '082119880954',
        ]);

        Artisan::call('passport:install');
    }
}
