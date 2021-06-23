<?php
namespace Jalno\Lumen\Tests;

use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Events\Dispatcher;
use Jalno\Lumen\Application;
use Jalno\Lumen\Contracts\IPackages;
use Jalno\Lumen\Packages\Repository;
use Jalno\Lumen\Database\Migrations\Migrator;
use Mockery as m;

class MigratorTest extends TestCase
{

	public Migrator $migrator;

	public function setUp(): void
	{
		$migrationRepositoryInterface = m::spy(MigrationRepositoryInterface::class);
		$connectionResolverInterface = m::spy(ConnectionResolverInterface::class);
		$filesystem = m::spy(Filesystem::class);
		$dispatcher = m::spy(Dispatcher::class);

		$this->migrator = new Migrator(
			$migrationRepositoryInterface,
			$connectionResolverInterface,
			$filesystem,
			$dispatcher,
			new Repository(new Application(null, PrimaryPackage::class)),
		);
	}

	public function testResolve(): void
	{
		$this->migrator->resolve();
	}

	public function testGetMigrationFiles(): void
	{
		$result = $this->migrator->getMigrationFiles([
			__DIR__ . "/M_20210614152058_JalnoConfigTest.php",
			"SOME_FAKE_PATH.php",
		]);

		$this->assertCount(1, $result);
	}

	public function testGetMigrationName(): void
	{
		$path = __DIR__ . "/M_20210614152058_JalnoConfigTest.php";
		$result = $this->migrator->getMigrationName($path);
		$this->assertEquals("\Jalno\Lumen\Tests\PrimaryPackage\Database\Migrations\M_20210614152058_JalnoConfigTest", $result);
	}

	public function testSortMigratationBasedOnPackages(): void
	{
		$result = $this->migrator->sortMigratationBasedOnPackages([
			__DIR__ . "/M_20210614152058_JalnoConfigTest.php",
			"/SOME_FAKE_PATH.php"
		]);

		$this->assertCount(1, $result);
	}

	protected function tearDown(): void
    {
        m::close();
    }
}
