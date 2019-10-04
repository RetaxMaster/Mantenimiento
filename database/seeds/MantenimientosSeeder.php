<?php

use App\Mantenimientos;
use Illuminate\Database\Seeder;

class MantenimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Mantenimientos::class, 20)->create();                                
    }
}
