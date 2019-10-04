<?php

use App\Sectores;
use Illuminate\Database\Seeder;

class SectoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Sectores::class, 4)->create();        
    }
}
