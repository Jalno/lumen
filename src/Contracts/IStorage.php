<?php
namespace Jalno\Lumen\Contracts;

use Illuminate\Contracts\Filesystem\Filesystem;

interface IStorage {

	public function __construct(IPackage $package);

	public function public(): Filesystem;
	public function private(): Filesystem;
	public function disk(string $name): Filesystem;
}
