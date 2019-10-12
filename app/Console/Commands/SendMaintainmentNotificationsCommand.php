<?php

namespace App\Console\Commands;

use App\Articulos;
use App\Mail\NotificationEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMaintainmentNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintainment:notificate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evía emails de los mantenimientos por vencer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $start_date = date("Y-m-d");
        $end_date = add_time($start_date, "3 días");

        $porVencer = Articulos::where("mantenimiento_hecho", "=", 0)->whereBetween("fecha_mantenimiento", [$start_date, $end_date])->get();

        foreach ($porVencer as $articulo) {
            $data["articulo"] = $articulo->master->name;
            $data["vence"] = $articulo->fecha_mantenimiento;
            $data["picture"] = $articulo->picture;
            foreach ($articulo->mantenimientos as $mantenimiento) {
                $data["name"] = $mantenimiento->user->name;
                $data["username"] = $mantenimiento->user->username;
                Mail::to($mantenimiento->user->email)->queue(new NotificationEmail($data));
            }
        }

        $this->info("Emails enviados");
    }
}
