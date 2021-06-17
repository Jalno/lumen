<?php
namespace Jalno\Lumen\Contracts;

use Psr\Container\ContainerInterface;
use Illuminate\Contracts\Container\Container;

interface IPackages extends ContainerInterface {

	public function __construct(Container $app);

	/**
	 * @param class-string<IPackage> $package
	 */
	public function register(string $package): void;

	/**
	 * @param class-string<IPackage> $package
	 */
	public function setPrimary(string $package): void;

	/**
	 * @return IPackage|null
	 */
	public function getPrimary(): ?IPackage;

	/**
	 * @return array<class-string<IPackage>,IPackage>
	 */
	public function all(): array;

	public function boot(): void;
}
