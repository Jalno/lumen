<?php
namespace Jalno\Lumen\Tests;

use Jalno\Lumen\Application;
use Jalno\Lumen\Packages\Repository;
use Jalno\Lumen\Contracts\IPackage;
use Jalno\Lumen\Database\MigrationServiceProvider;

class MigrationServiceProviderTest extends TestCase
{
	public function testRegister(): void
	{
		$app = new Application(null, PrimaryPackage::class);
		$app->register(MigrationServiceProvider::class);
		$this->assertTrue(true);
	}
}
