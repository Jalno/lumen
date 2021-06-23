<?php
namespace Jalno\Lumen\Tests;

use Jalno\Lumen\Application;
use Jalno\Lumen\Packages\Repository;
use Jalno\Lumen\Contracts\IPackage;

class RepositoryTest extends TestCase
{

    protected Repository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new Repository(new Application(null, PrimaryPackage::class));
    }

    public function testConstruct(): void
    {
        $this->assertCount(0, $this->repository->all());
        $this->assertNull($this->repository->getPrimary());
    }

    /**
     * @depends testConstruct
     */
    public function testRegister(): void
    {
        $this->assertFalse($this->repository->has(PrimaryPackage::class));
        $this->repository->register(PrimaryPackage::class);
        $this->assertTrue($this->repository->has(PrimaryPackage::class));

        $all = $this->repository->all();
        $this->assertCount(1, $all);
        $this->assertTrue(isset($all[PrimaryPackage::class]));

        $this->repository->register("\\" . PrimaryPackage::class);
        $this->assertCount(1, $this->repository->all());

        $this->repository->register(SecondaryPackage::class);
        $this->assertCount(2, $this->repository->all());


        $this->setUp();
        $this->repository->register(SecondaryPackage::class);
        $this->assertCount(2, $this->repository->all());


        $this->setUp();
        $firstPackage = new class() extends PrimaryPackage
        {
            public static array $___dependencies = [];
            public function getDependencies(): array
            {
                return self::$___dependencies;
            }
        };
        $secondPackage = new class() extends PrimaryPackage
        {
            public static array $___dependencies = [];
            public function getDependencies(): array
            {
                return self::$___dependencies;
            }
        };
        $firstPackage::$___dependencies = [get_class($secondPackage)];
        $secondPackage::$___dependencies = [get_class($firstPackage)];

        $this->repository->register(get_class($secondPackage));

    }

    /**
     * @depends testRegister
     */
    public function testGet(): void
    {
        $this->repository->register(PrimaryPackage::class);
        $package = $this->repository->get(PrimaryPackage::class);
        $this->assertInstanceOf(PrimaryPackage::class, $package);

        $package = $this->repository->get("\\" . PrimaryPackage::class);

        $this->expectException(\Illuminate\Container\EntryNotFoundException::class);
        $this->repository->get(SecondaryPackage::class);
    }

    /**
     * @depends testRegister
     * @dataProvider registeredRepositoryProvider
     */
    public function testAll(Repository $repository): void
    {
        foreach ($repository->all() as $packageString => $packageObject) {
            $this->assertInstanceOf(IPackage::class, $packageObject);
            $this->assertInstanceOf($packageString, $packageObject);
        }
    }

    /**
     * @depends testRegister
     * @dataProvider registeredRepositoryProvider
     */
    public function testSetupRouterIsWorking(Repository $repository): void
    {
        $repository->setupRouter();
        $this->assertTrue(true);
    }

    /**
     * @depends testRegister
     * @dataProvider registeredRepositoryProvider
     */
    public function testBoot(Repository $repository): void
    {
        $repository->boot();
        $this->assertTrue(true);
    }

    public function registeredRepositoryProvider()
    {
        $this->setUp();
        $this->repository->register(PrimaryPackage::class);
        $this->repository->register(SecondaryPackage::class);
        return [[$this->repository]];
    }
}
