<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
    }
}

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'carlos',
            'password' => Hash::make('1234'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'user',
            'password' => Hash::make('1234'),
            'is_admin' => false,
        ]);
    }
}
