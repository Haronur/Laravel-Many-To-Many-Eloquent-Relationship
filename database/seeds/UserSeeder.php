<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John',
            'email' => 'John@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Ronald',
            'email' => 'Ronald@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Gary',
            'email' => 'Gary@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
