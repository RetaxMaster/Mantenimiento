<?php

use App\Articulos;
use Illuminate\Database\Seeder;

class ArticulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Articulos::class, 100)->create();                        
    }
}
