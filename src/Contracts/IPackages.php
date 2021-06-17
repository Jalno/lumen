<?php
namespace Jalno\Lumen\Contracts;

use Psr\Container\ContainerInterface;
use Illuminate\Contracts\Foundation\Application;

interface IPackages extends ContainerInterface {

	public function __construct(Application $app);

	/**
	 * @var class-string<IPackage> $package
	 */
	public function register(string $package): void;

	/**
	 * @var class-string<IPackage> $package
	 */
	public function setPrimary(string $package): void;

	/**
	 * @return IPackage|null
	 */
	public function getPrimary(): ?IPackage;

	/**
	 * @return array<class-string,IPackage>
	 */
	public function all(): array;

	public function boot(): void;
}
