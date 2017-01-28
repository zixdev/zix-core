<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakeEvent
 * @package Zix\Core\Console\Commands
 */
class MakeEvent extends GeneratorCommand
{

	use StubGeneratorTrait;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'zix:make-event {name : The Event Name}
										{module : The Module Name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Event class.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->stubPath = "modules/Core/Console/Commands/stubs/event.stub";
		$this->generatePath = 'Events';

		$this->fire();
	}
}
