<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakePolicy
 * @package Zix\Core\Console\Commands
 */
class MakePolicy extends GeneratorCommand
{
    use StubGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make-policy {name : The Policy Name}
											{module : The Module Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Policy class.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generatePath = 'Policies';
        $this->stubPath = "modules/Core/Console/Commands/stubs/policy.stub";

        $this->fire();
    }

}
