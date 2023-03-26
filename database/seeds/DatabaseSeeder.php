<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HospedeSeeder::class);

        $this->call(QuartoSeeder::class);
        //$this->call(QuartoSeeder::class);
    }
}
