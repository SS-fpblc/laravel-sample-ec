<?php

namespace Database\Seeders;

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
        $testuser = new \App\Models\User([
            'name' => 'testuser',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);
        $testuser->save();
        
        $admin = new \App\Models\User([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $admin->save();
        
    }
}
