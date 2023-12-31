<?php

namespace DotenvVault\Laravel\Tests;

use DotenvVault\Laravel\DotenvVaultServiceProvider;
use Illuminate\Config\Repository;
use phpmock\phpunit\PHPMock;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use PHPMock;

    public $enablesPackageDiscoveries = true;
    public $loadEnvironmentVariables = false;

    protected function getPackageProviders($app)
    {
        return [
            DotenvVaultServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) use ($app) {
            $error_log = $this->getFunctionMock('DotenvVault', 'error_log');
            $error_log->expects($this->any());

            $defaults = require __DIR__ . '/../config/dotenv-vault.php';
            $this->assertSame([
                'path' => $this->getBasePath(),
                'key_name' => 'key.env',
            ], $defaults);

            // override vault path with fixture dir
            $config->set('dotenv-vault.path', $this->getFixturePath());
            $config->set('dotenv-vault.key_name', $this->getKeyName());
        });
    }

    /** @return string|string[] */
    abstract protected function getFixturePath();

    protected function getKeyName(): string
    {
        return 'key.env';
    }
}
