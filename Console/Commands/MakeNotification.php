<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakeNotification
 * @package Zix\Core\Console\Commands
 */
class MakeNotification extends GeneratorCommand
{
	use StubGeneratorTrait;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'zix:make-notification {name : The Notification Name}
												  {module : The Module Name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Notification class.';


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->generatePath = 'Notifications';
		$this->stubPath = "modules/Core/Console/Commands/stubs/notification.stub";

		$this->fire();
	}

}
