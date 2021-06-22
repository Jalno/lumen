<?php
namespace Jalno\Lumen\Tests;

use Laravel\Lumen\Routing\Router;
use Jalno\Lumen\Packages\PackageAbstract;

class PrimaryPackage extends PackageAbstract
{

    public function getProviders(): array
    {
        return [];
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