<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'CEO',
            'role' => 'admin',
            'verified' => 1,
            'verification_code' => null,
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
    }
}
