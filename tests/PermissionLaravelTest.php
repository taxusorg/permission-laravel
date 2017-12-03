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

        Permission::setFactoryCallback(function () {
            return $this->factory;
        });
    }

    public function testRepository()
    {
        /*$this->repository->find(1)->addAllows(['class1', 'class2']);
        $this->repository->find(1)->addAllows(['class1', 'class3']);
        $this->repository->find(1)->addAllows(['class5', 'class6']);

        $this->repository->find(1)->deleteAllows(['class1']);*/

        //$this->repository->find(1)->allows()->delete();

        $this->assertTrue(true);
    }

    public function testFactory()
    {
        $this->assertTrue(true);
    }
}
