<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EvolutionTableSeeder extends Seeder
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
            ['character_template_id' => 1, 'require_exp' => 500, 'default_evolute_id' => 2],
            ['character_template_id' => 2, 'require_exp' => 1200, 'default_evolute_id' => 3]
        ];

        DB::table('evolutions')->insert($arrays);
    }

}
