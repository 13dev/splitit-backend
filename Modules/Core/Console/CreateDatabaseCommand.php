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

        $databaseName = config('database.connections.mysql.database');
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        config(['database.connections.mysql.database' => null]);

        //create database
        DB::statement(
            sprintf(
                'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
                $databaseName,
                $charset,
                $collation
            )
        );

        config(['database.connections.mysql.database' => $databaseName]);

        $this->info("Database {$databaseName} created!");

        return true;
    }
}
