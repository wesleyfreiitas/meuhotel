<?php

use Illuminate\Database\Seeder;

class HospedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospedes')->insert(['nome'=>'Katusha', 'email'=>'kcorradi0@cbsnews.com']);
        DB::table('hospedes')->insert(['nome'=>'Bernie', 'email'=>'bczadla1@4shared.com']);
        DB::table('hospedes')->insert(['nome'=>'Abbie', 'email'=>'abreckon2@tinyurl.com']);
        DB::table('hospedes')->insert(['nome'=>'Burt', 'email'=>'bleser3@shop-pro.jp']);
        DB::table('hospedes')->insert(['nome'=>'Nananne', 'email'=>'nwager4@pinterest.com']);
        DB::table('hospedes')->insert(['nome'=>'Travis', 'email'=>'tdablingrr@dropbox.com']);
    }
}
