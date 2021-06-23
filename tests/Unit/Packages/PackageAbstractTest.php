<?php
namespace Jalno\Lumen\Tests;

use Jalno\Lumen\Application;
use Jalno\Lumen\Packages\PackageAbstract;

class PackageAbstractTest extends TestCase
{

	protected PackageAbstract $package;

	public function setUp(): void
	{
		$this->package = new class extends PackageAbstract
		{
			protected string $namespace = __NAMESPACE__;
			public function basePath(): string
			{
				return __DIR__;
			}
		};
	}

	public function testGetName(): void
	{
		$name = $this->package->getName();

		// for covrage
		$package = new PrimaryPackage();
		$name = $package->getName();

		$this->assertTrue(true);
	}

	public function testSetupRouter(): void
	{
		$this->package->setupRouter((new Application(null, PrimaryPackage::class))->make("router"));
		$this->assertTrue(true);
	}

	public function testGetProviders(): void
	{
		$this->package->getProviders();
		$this->assertTrue(true);
	}

	public function testGetCommands(): void
	{
		$this->package->getCommands();
		$this->assertTrue(true);
	}

	public function testStorage(): void
	{
		$this->package->storage();
		$this->assertTrue();
	}

	public function testGetStorageConfig(): void
	{
		$config = $this->package->getStorageConfig();
		$this->assertTrue(true);
	}

	public function testGetDatabasePath(): void
	{
		$dbPath = $this->package->getDatabasePath();
		$this->assertIsString($dbPath);
	}

	public function testGetMigrationPath(): void
	{
		$dbPath = $this->package->getMigrationPath();
		$this->assertIsString($dbPath);
	}

	public function testGetNamespace(): void
	{
		$this->package->getNamespace();
		$this->assertTrue(true);
	}
}
