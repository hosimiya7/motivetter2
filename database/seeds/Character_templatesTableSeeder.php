<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Character_templatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('character_template')->insert([
            'name' => 'もっちー',
            'lines' => 'もちもち…、もちもち…'
        ]);
    }
}
