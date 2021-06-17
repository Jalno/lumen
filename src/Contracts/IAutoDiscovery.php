<?php
namespace Jalno\Lumen\Contracts;

use Laravel\Lumen\Application;

interface IAutoDiscovery {
	public function __construct(Application $app);
	public function register(): void;
}