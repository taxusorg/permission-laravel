<?php

namespace Tests;

use Dotenv\Dotenv;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\MySqlConnection;
use PHPUnit\Framework\TestCase;
use Taxusorg\Permission\Factory;
use Taxusorg\Permission\Permissions\Permission;
use Taxusorg\PermissionLaravel\Repository\RoleRepository;
use Tests\Permissions\Testing1;
use Tests\Permissions\Testing2;
use Tests\Permissions\Testing3;
use Tests\Permissions\Testing5;

class PermissionLaravelTest extends TestCase
{
    protected $factory;

    protected $repository;

    public function __construct(...$p)
    {
        parent::__construct(...$p);

        date_default_timezone_set('PRC');
        $dotenv = new Dotenv('./');
        $dotenv->load();

        $connection = new ConnectionResolver([
            'mysql' => new MySqlConnection(
                new \PDO(
                    "mysql:host=" . env('DB_HOST', '127.0.0.1') .
                    ";port=" . env('DB_PORT', '3306') .
                    ";dbname=" . env('DB_DATABASE', 'forge'),
                    env('DB_USERNAME', 'forge'),
                    env('DB_PASSWORD', '')
                )
            ),
        ]);
        $connection->setDefaultConnection('mysql');
        Model::setConnectionResolver($connection);

        $this->repository = new RoleRepository();
        $this->factory = new Factory($this->repository);
        $this->factory->setRolesDefault(1);
        $this->factory->registerPermissions([
            Testing1::class,
            Testing2::class,
            Testing3::class,
            Testing4::class,
            Testing5::class,
        ]);

        Permission::setFactoryCallback(function () {
            return $this->factory;
        });
    }

    public function testRepository()
    {
        $this->factory->role(1)->addAllows([Testing1::class, Testing2::class]);
        $this->factory->role(1)->addAllows([Testing1::class, Testing3::class]);
        $this->factory->role(1)->addAllows([Testing5::class]);

        $this->factory->role(1)->deleteAllows([Testing1::class]);

        //$this->repository->find(1)->allows()->delete();

        $this->assertTrue(true);
    }

    public function testFactory()
    {
        $this->assertTrue(true);
    }

    public function testRoles()
    {
        print_r($this->factory->role(1)->allows(Testing1::getClass()));
        $this->assertFalse(Testing1::check());
        $this->assertTrue(Testing2::check());
    }
}
