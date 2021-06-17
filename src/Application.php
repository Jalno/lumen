<?php
namespace Jalno\Lumen;

use Laravel\Lumen\Application as ParentApplication;
use Jalno\AutoDiscovery\Providers\AutoDiscoverProvider;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;

/**
 * @property Contracts\IPackages $packages
 */
class Application extends ParentApplication
{

    /**
     * Create a new Lumen application instance.
     *
     * @param  string|null  $basePath
     * @param class-string<Contracts\IPackage> $primaryPackage
     * @return void
     */
    public function __construct($basePath, string $primaryPackage)
    {
        $this->register(Packages\PackagesServiceProvider::class);
        $this->packages->setPrimary($primaryPackage);
        parent::__construct($basePath);
        $this->singleton(ConsoleKernelContract::class, Console\Kernel::class);
        $this->register(AutoDiscoverProvider::class);
    }

    /**
     * Get the path to the application "src" directory.
     *
     * @return string
     */
    public function path()
    {
        $primaryPackage = $this->packages->getPrimary();
        if ($primaryPackage) {
            return $primaryPackage->basePath();
        }
        return parent::path();
    }

    /**
     * Get the path to the database directory.
     *
     * @param  string  $path
     * @return string
     */
    public function databasePath($path = '')
    {
        $primaryPackage = $this->packages->getPrimary();
        if ($primaryPackage) {
            return $primaryPackage->getDatabasePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
        }
        return parent::databasePath($path);
    }

    /**
     * Prepare the application to execute a console command.
     *
     * @param  bool  $aliases
     * @return void
     */
    public function prepareForConsoleCommand($aliases = true)
    {
        parent::prepareForConsoleCommand($aliases);
        $this->register(Database\MigrationServiceProvider::class);
    }
}
