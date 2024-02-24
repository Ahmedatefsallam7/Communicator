<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Ahmed Atef",
            'email' => "ahmedatefsallam7@gmail.com",
            'phone' => "01026556692",
            'password' => bcrypt('12341234'),
        ]);
    }
}
