<?php

namespace DotenvVault\Laravel;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use DotenvVault\DotEnvVault;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Log\Logger;
use Illuminate\Support\ServiceProvider;

class DotenvVaultServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->booting(function (Application $app) {
            /** @var Repository $config */
            $config = $app->get('config');
            /** @var Logger $log */
            $log = $app->get('log');
            $paths = (array) $config->get('dotenv-vault.path', base_path());

            $keyName = $config->get('dotenv-vault.key_name', 'key.env');
            Dotenv::createImmutable($paths, $keyName)->safeLoad();

            $vaultName = $config->get('dotenv-vault.vault_name', '.env.vault');
            try {
                DotEnvVault::createImmutable($paths, $vaultName)->load();
            } catch (InvalidPathException $error) {
                $log->warning("Unable to decrypt DotEnv Vault: {$vaultName}");
                $log->warning("  because: {$error->getMessage()}");
            }
        });
    }

    public function boot(): void
    {
        $this->publishes(
            [__DIR__ . '/../config/dotenv-vault.php' => config_path('dotenv-vault.php')],
            ['dotenv-vault']
        );
    }
}
