<?php
namespace Jalno\Lumen\Tests;

use Jalno\Lumen\Application;
use Jalno\Lumen\Console\Kernel;
use Jalno\Lumen\Packages\Repository;

class KernelTest extends TestCase
{

	public function testConstruct(): void
	{
		$app = new Application(null, PrimaryPackage::class);
		$kernel = new Kernel($app, new Repository($app));
		$this->assertTrue(true);
	}

}
