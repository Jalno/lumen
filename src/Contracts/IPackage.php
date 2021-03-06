<?php
namespace Jalno\Lumen\Contracts;

use Laravel\Lumen\Routing\Router;
use Illuminate\Contracts\Filesystem\Filesystem;

interface IPackage {
	/**
	 * @return array<class-string<\Illuminate\Support\ServiceProvider>>
	 */
	public function getProviders(): array;

	/**
	 * @return array<class-string<IPackage>>
	 */
	public function getDependencies(): array;
	public function basePath(): string;
	public function getDatabasePath(): string;
	public function getMigrationPath(): string;
	public function getNamespace(): string;
	public function setupRouter(Router $router): void;
	public function path(string ...$path): string;
	/**
     * Get the commands to add to the application.
     *
     * @return array<class-string>
     */
	public function getCommands(): array;

	public function storage(): IStorage;
	public function disk(string $name): Filesystem;

	/**
	 * @return array<array<string,string|bool|mixed>>
	 */
	public function getStorageConfig(): array;
	public function getName(): string;
}