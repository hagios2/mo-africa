<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Ruddy DAB',
            'email' => 'ruddy@gmail.com',
            'phone' => '0277030209',
            'password' => bcrypt('ruddyy#!@@#%pass')
        ]);
    }
}
