<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->truncateTables(["users", "sectores", "sucursales", "masters", "articulos", "mantenimientos"]);
        
        /* $this->call(UserSeeder::class);
        $this->call(SectoresSeeder::class);
        $this->call(SucursalesSeeder::class);
        $this->call(MasterSeeder::class);
        $this->call(ArticulosSeeder::class);
        $this->call(MantenimientosSeeder::class); */
    }

    public function truncateTables(array $tables) {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        foreach ($tables as $table) DB::table($table)->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
    }
}
