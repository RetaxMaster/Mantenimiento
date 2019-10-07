<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StorageMediaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un enlace simbólico hacia la carpeta media';

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
        if (file_exists(public_path('storage'))) {
            return $this->error('The "media" directory already exists.');
        }
        $this->laravel->make('files')->link(
            storage_path('media'),
            public_path('storage')
        );
        $this->info('The [media] directory has been linked.');
    }
}
