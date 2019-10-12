<?php

namespace App\Console\Commands;

use App\Articulos;
use Illuminate\Console\Command;

class verifyPastMaintainmentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintainment:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica los mantenimientos que ya vencieron';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        Articulos::where("fecha_mantenimiento", "<=", date("Y-m-d"))->update([
            "mantenimiento_hecho" => 2
        ]);
        $this->info("Revisión terminada");
    }
}
