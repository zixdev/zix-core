<?php

namespace Zix\Core\Console\Commands;

use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;
use Illuminate\Database\Console\Migrations\BaseCommand;


/**
 * Class MakeMigration
 * @package Zix\Core\Console\Commands
 */
class MakeMigration extends BaseCommand
{
    use StubGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make-migration {name : The Migration Name}
											   {module : The Module Name}
											   {create : The table to be created.}
                                               {--table= : The table to migrate.}
                                               {--path= : The location where the migration file should be created.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Migration class.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('make:migration', [
            'name'  => $this->argument('name'),
            '--create' => $this->argument('create'),
            '--path'    => "modules/".$this->argument('module')."/Database/Migrations"
        ]);
    }


}
