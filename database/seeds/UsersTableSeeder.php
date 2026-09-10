<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->updateOrInsert(
            ['email' => 'leatherket@gmail.com'],
            [
                'name' => 'Leatherket Admin',
                'phone' => null,
                'password' => Hash::make('12345678'),
                'role_id' => 1,
                'status' => 'Active',
                'email_verified_at' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
