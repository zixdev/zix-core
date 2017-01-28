<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakeMail
 * @package Zix\Core\Console\Commands
 */
class MakeMail extends GeneratorCommand
{
    use StubGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zix:make-mail {name : The Mail Name}
										  {module : The Module Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Mail class.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generatePath = 'Mail';
        $this->stubPath = "modules/Core/Console/Commands/stubs/mail.stub";

        $this->fire();
    }

}
