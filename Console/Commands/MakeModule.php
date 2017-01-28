<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\Command;
use Zix\Core\Console\Generators\ModuleGenerator;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make {name : The module name}
                                     {--empty : Generate Empty Module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Module.';

    /**
     * @var ModuleGenerator
     */
    private $moduleGenerator;

    /**
     * Create a new command instance.
     * @param ModuleGenerator $moduleGenerator
     */
    public function __construct(ModuleGenerator $moduleGenerator)
    {
        parent::__construct();
        $this->moduleGenerator = $moduleGenerator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->moduleGenerator
            ->setConsole($this)
            ->generate();

    }
}
