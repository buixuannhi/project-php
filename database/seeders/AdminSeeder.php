<?php

namespace Database\Seeders;

use App\Models\Backend\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Pham Ngoc Linh',
            'email' => 'phamlinhaz229@gmail.com',
            'password' => Hash::make('18122002')
        ]);
    }
}
