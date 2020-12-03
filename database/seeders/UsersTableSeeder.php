<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'amr',
            'last_name'  => 'samy',
            'email'      => 'amrsamy@gmail.com',
            'profile_photo_path'=>'storage/images/defaultProfileImage.png',
            'password'   => bcrypt('12344321')
        ]);
        $user->attachRole('super_admin');
    }
}
