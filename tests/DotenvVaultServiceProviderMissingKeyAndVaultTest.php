<?php

declare(strict_types=1);

namespace DotenvVault\Laravel\Tests;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderMissingKeyAndVaultTest extends TestCase
{
    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/empty';
    }

    public function test(): void
    {
        $this->assertEmpty(env('DOTENV_KEY'));
        $this->assertEmpty(env('DOTENV_VAULT_DEVELOPMENT'));
        $this->assertEmpty(env('DOTENV_VAULT_PRODUCTION'));
        $this->assertEmpty(env('APP_ENV'));
        $this->assertEmpty(env('APP_KEY'));
    }
}
