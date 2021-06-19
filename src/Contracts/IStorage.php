<?php
namespace Jalno\Lumen\Contracts;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Filesystem\Filesystem;

interface IStorage {

	public function __construct(Container $app, IPackage $package);

	public function public(): Filesystem;
	public function private(): Filesystem;
	public function disk(string $name): Filesystem;
}