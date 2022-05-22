<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email'    => 'admin@example.com'
            ],
            [
                'name'     => 'Admin',
                'password' => bcrypt(111111)
            ]
        );
    }
}