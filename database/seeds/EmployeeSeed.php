<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ismail Hossain',
            'email' => 'ismail@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Jr. Frontend Developer',
            'role' => 'employee',
            'verified' => 1,
            'verification_code' => null,
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Joy Mojumder',
            'email' => 'joy@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Jr. Frontend Developer',
            'role' => 'employee',
            'verified' => 1,
            'verification_code' => null,
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Imran rahman',
            'email' => 'imran@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Jr. Graphies Designer',
            'role' => 'employee',
            'verified' => 1,
            'verification_code' => null,
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Rashed Rabbi',
            'email' => 'rashed@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Jr. Graphies Designer',
            'role' => 'employee',
            'verified' => 1,
            'verification_code' => null,
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mahbubur Rahman',
            'email' => 'mahbub@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Manager',
            'role' => 'employee',
            'verified' => 1,
            'verification_code' => null,
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
    }
}
