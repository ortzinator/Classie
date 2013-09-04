<?php namespace Ortzinator\Classie\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Config\Repository as Config;

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'classie:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Installs Classie';

	protected $file;
	protected $config;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Filesystem $file, Config $config)
	{
		parent::__construct();

		$this->file = $file;
		$this->config = $config;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$dbPath = $this->config->get('database.connections.sqlite.database');

		if ($this->config->get('database.default') == 'sqlite' && 
			!$this->file->exists($dbPath))
		{
			$this->file->put($dbPath, '');
			$this->comment('Classie successfully installed');
		}
		else
		{
			$this->comment('Nothing to do');
		}
	}
}