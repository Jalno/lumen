<?php
namespace Jalno\Lumen\Packages;

use Illuminate\Container\EntryNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Jalno\Lumen\Contracts\{IPackages, IPackage};

class Repository implements IPackages {

	public Application $app;

	/**
	 * @var array<class-string,IPackage>
	 */
	protected array $packages = [];

	/**
	 * @var class-string<IPackage> $primary
	 */
	protected ?string $primary = null;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * @var class-string<IPackage> $package
	 */
	public function register(string $packageClass): void
	{
		if (isset($this->packages[$packageClass])) {
			return;
		}
		$package = new $packageClass();
		foreach ($package->getDependencies() as $dependency) {
			$this->register($dependency);
		}
		$this->packages[get_class($package)] = $package;

	}

	/**
	 * @param class-string<IPackage> $package
	 */
	public function setPrimary(string $package): void
	{
		$this->register($package);
		$this->primary = $package;
	}

	public function getPrimary(): ?IPackage
	{
		return $this->primary ? $this->get($this->primary) : null;
	}

	/**
	 * @param class-string<IPackage> $package
	 */
	public function has($package): bool
	{
		return isset($this->packages[$package]);
	}

	/**
	 * @param class-string<IPackage> $package
	 * @throws EntryNotFoundException  No package was found for **this** identifier.
	 */
	public function get($package): IPackage
	{
		if (!$this->has($package)) {
			throw new EntryNotFoundException();
		}
		return $this->packages[$package];
	}

	public function all(): array
	{
		return $this->packages;
	}

	public function setupRouter(): void
	{
		foreach ($this->packages as $package) {
			$package->setupRouter($this->app->make("router"));
		}
	}

	public function boot(): void
	{
		foreach ($this->packages as $package) {
			foreach ($package->getProviders() as $provider) {
				$this->app->register($provider);
			}
		}
	}
}
