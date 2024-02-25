<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pet = new \App\Models\Category([
            'name' => 'pet',
        ]);
        $pet->save();
        
        $food = new \App\Models\Category([
            'name' => 'food',
        ]);
        $food->save();
        
        $fashion = new \App\Models\Category([
            'name' => 'fashion',
        ]);
        $fashion->save();
        
    }
}