<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'                  => 'Admin',
            'email'                 => 'admin@admin.com',
            'password'              => password_hash('adminpass', PASSWORD_DEFAULT),
            'email_verified_at'     => now(),
        ]);
    }
}
