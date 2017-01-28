<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakeCommand
 * @package Zix\Core\Console\Commands
 */
class MakeCommand extends GeneratorCommand
{
    use StubGeneratorTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make-command {name : The Command Name}
                                             {module : The Module Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Artisan command.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generatePath = 'Console/Commands';
        $this->stubPath = 'modules/Core/Console/Commands/stubs/command.stub';

        $this->fire();
    }
}