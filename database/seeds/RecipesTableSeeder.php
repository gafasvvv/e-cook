<?php

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for($i = 1; $i <=30; $i++){
            DB::table('recipes')->insert([
                'name' => 'test name' . $i,
                'content' => 'test content' . $i,
                // 'ingredient' => 'test ingredient' . $i,
                // 'quantity' => 'test quantity' . $i,
                // 'how_to_make' => 'test how_to_make' . $i,
            ]);
        }
    }
}
