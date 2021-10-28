<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Evolute_foodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrays = [
            ['character_template_id' =>	2, 'food_id' => 1, 'require_quantity' => 20, 'to_evolute_id' => 8, 'priority' => 5],
            ['character_template_id' =>	2, 'food_id' => 1, 'require_quantity' => 60, 'to_evolute_id' => 10, 'priority' => 1],
            ['character_template_id' =>	2, 'food_id' => 2, 'require_quantity' => 20, 'to_evolute_id' => 6, 'priority' => 7],
            ['character_template_id' =>	2, 'food_id' => 2, 'require_quantity' => 60, 'to_evolute_id' => 4, 'priority' => 4],
            ['character_template_id' =>	2, 'food_id' => 3, 'require_quantity' => 20, 'to_evolute_id' => 5, 'priority' => 6],
            ['character_template_id' =>	2, 'food_id' => 3, 'require_quantity' => 60, 'to_evolute_id' => 7, 'priority' => 2],
            ['character_template_id' =>	2, 'food_id' => 4, 'require_quantity' => 50, 'to_evolute_id' => 9, 'priority' => 3],
            ['character_template_id' =>	3, 'food_id' => 2, 'require_quantity' => 100, 'to_evolute_id' => 11, 'priority' => 8]

        ];
        DB::table('evolute_foods')->insert($arrays);
    }
}
