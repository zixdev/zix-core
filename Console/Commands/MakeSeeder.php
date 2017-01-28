<?php

namespace Zix\Core\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Zix\Core\Console\Generators\Traits\StubGeneratorTrait;

/**
 * Class MakeSeeder
 * @package Zix\Core\Console\Commands
 */
class MakeSeeder extends GeneratorCommand
{
	use StubGeneratorTrait;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'zix:make-seeder {name : The Seeder Name}
											{module : The Module Name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Seeder class.';


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->generatePath = 'Database/Seeds';
		$this->stubPath = "modules/Core/Console/Commands/stubs/seeder.stub";

		$this->fire();
	}

}
