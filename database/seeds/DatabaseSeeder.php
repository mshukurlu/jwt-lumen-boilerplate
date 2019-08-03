<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        DB::table('users')->insert([
            'email'=>'admin@admin.com',
            'password'=>Hash::make('123456'),
            'name'=>'Murad Shukurlu'
        ]);
    }
}
