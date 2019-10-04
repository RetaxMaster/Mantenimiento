<?php

use App\Sucursales;
use Illuminate\Database\Seeder;

class SucursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Sucursales::class, 10)->create();        
    }
}
