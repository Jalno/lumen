<?php
namespace Jalno\Lumen\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
	public function setUp(): void
	{
		parent::setUp();
	}

	protected function getPackageProviders($app)
	{
		return [];
	}

	protected function getEnvironmentSetUp($app)
	{
		// ..
	}
}
