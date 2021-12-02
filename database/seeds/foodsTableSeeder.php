<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FoodsTableSeeder extends Seeder
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
            "いちご" => "50",
            "もち" => "60",
            "めろん" => "100",
            "葉っぱ" => "20",
        ];

        foreach ($arrays as $name => $price) {
            DB::table('foods')->insert(['name' => $name, "price" => $price]);
        };
    }
}
