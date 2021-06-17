<?php
namespace Jalno\Lumen\Packages;

use Jalno\Lumen\Contracts;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class PackagesServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $package = new Repository($this->app);
        $this->app->instance(Contracts\IPackages::class, $package);
        $this->app->instance("packages", $package);
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [Contracts\IPackages::class];
    }
}
