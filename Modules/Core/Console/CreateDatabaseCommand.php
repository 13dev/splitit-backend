<?php

namespace Modules\Core\Console;

use DB;
use Illuminate\Console\Command;

class CreateDatabaseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the database if not exists.';

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
    public function handle()
    {
        $this->info('Creating database...');
        DB::statement(
            sprintf('CREATE DATABASE IF NOT EXISTS %s', env('DB_DATABASE'))
        );

        $this->info('Database created!');
    }
}
