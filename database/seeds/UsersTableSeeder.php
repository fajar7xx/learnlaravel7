<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'fajar7xx@mail.com',
            'username' => 'fajar7xx',
            'password' => Hash::make('azhari30'),
            'name' => 'fajar siagian'
        ]);
    }
}
