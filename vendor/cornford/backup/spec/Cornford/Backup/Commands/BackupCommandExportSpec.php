<?php namespace spec\Cornford\Backup\Commands;

use PhpSpec\ObjectBehavior;
use Mockery;
use Prophecy\Argument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Helper\HelperSet;
use Illuminate\Console\Command;

class BackupCommandExportSpec extends ObjectBehavior {

	private $options = [];

	public function let()
	{
		$backup = Mockery::mock('Cornford\Backup\Backup');
		$backup->shouldReceive('setEnabled');
		$backup->shouldReceive('setPath');
		$backup->shouldReceive('getWorkingFilepath')->andReturn('');
		$backup->shouldReceive('export')->andReturn(true);

		$backupFactory = Mockery::mock('Cornford\Backup\BackupFactory');
		$backupFactory->shouldReceive('build')->andReturn($backup);

		$configInstance = Mockery::mock('Illuminate\Config\Repository');
		$configInstance->shouldReceive('get')->andReturn([]);

		$this->beConstructedWith($backupFactory, $configInstance);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Cornford\Backup\Commands\BackupCommandExport');
	}

	function it_should_get_a_backup_instance()
	{
		$this->getBackupInstance()->shouldHaveType('Cornford\Backup\Contracts\BackupInterface');
	}

	function it_should_execute_when_calling_fire_action(HelperSet $helpers)
	{
		$input = new ArrayInput([]);
		$output = new NullOutput;
		$this->setHelperSet($helpers);
		$this->run($input, $output);
		$this->fire();
	}

}
