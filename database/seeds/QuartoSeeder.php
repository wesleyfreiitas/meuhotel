<?php

use Illuminate\Database\Seeder;

class QuartoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quartos')->insert(['nome' => 'B01', 'status' => 'LIVRE', 'vlr_diaria' => 350]);
        DB::table('quartos')->insert(['nome' => 'B02', 'status' => 'LIVRE', 'vlr_diaria' => 350]);
        DB::table('quartos')->insert(['nome' => 'B03', 'status' => 'LIVRE', 'vlr_diaria' => 350]);
        DB::table('quartos')->insert(['nome' => 'B04', 'status' => 'LIVRE', 'vlr_diaria' => 350]);
        DB::table('quartos')->insert(['nome' => 'B05', 'status' => 'LIVRE', 'vlr_diaria' => 350]);

    }
}
