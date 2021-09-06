<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arrays = [
            'もっちー' => 'ごはんまだ～？？',
            'やきもっちー' => '実は頭の上のやつ邪魔なんだよね',
            'とけもっちー' => '…(自分が溶けてなくなってしまうのではないかと心配している)',
            'もちだんご' => '3つで1つみたいなものなんだ',
            'きなここ' => '黄色いの可愛いでしょ。もち界での流行りなの',
            'ピッツァ' => 'うかつに触れるとやけどするぞ…。',
            'しょうゆもち' =>  'もごもご(海苔が口にくっついて話しづらそうだ)',
            'ぜんざい師匠' =>  '人生って自分で好きに作っていくものよ。おやつになるもご飯になるもあなた次第',
            'さくらももち' => 'はぁ…やっぱり葉っぱの中は落ち着く…たまには休憩しなさいよ？',
            'おはぎん' => 'こしあんとつぶあんどっちがいい？？',
            'ねこもち' => 'にゃ～～～～～～',
        ];

        foreach ($arrays as $name => $line) {
            DB::table('character_templates')->insert(['name' => $name, 'line' => $line]);
        };
    }
}
