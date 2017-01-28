<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakeController
 * @package Zix\Core\Console\Commands
 */
class MakeController extends GeneratorCommand
{

    use StubGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make-controller {name : The Controller Name}
                                                {module : The Module Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Controller class.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generatePath = 'Http/Controllers';
        $this->stubPath = 'modules/Core/Console/Commands/stubs/controller.stub';

        $this->fire();
    }

}
