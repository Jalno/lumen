<?php
namespace Jalno\Lumen\Tests;

use Laravel\Lumen\Routing\Router;
use Jalno\Lumen\Packages\PackageAbstract;

class SecondaryPackage extends PackageAbstract
{

    public function getDependencies(): array
    {
        return [PrimaryPackage::class];
    }

    public function getProviders(): array
    {
        return [SampleServiceProvider::class];
    }

    public function basePath(): string
    {
        return __DIR__;
    }

    public function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    public function setupRouter(Router $router): void
    {
        // ..
    }
}