<?php

namespace DotenvVault\Laravel\Tests;

use ErrorException;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderMissingVaultTest extends TestCase
{
    /** @var ErrorException|null */
    private $exception;

    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/missing_vault';
    }

    protected function setUp(): void
    {
        try {
            $this->exception = null;
            parent::setUp();
        } catch (ErrorException $exception) {
            $this->exception = $exception;
        }
    }

    public function test(): void
    {
        $this->assertInstanceOf(ErrorException::class, $this->exception);
        $this->assertStringContainsString('You set DOTENV_KEY but you are missing a .env.vault file', $this->exception->getMessage());
        $this->assertSame('dotenv://:key_e3405d44ee2213b42a7e393881e06588d84f06474923e5a11ffe4db282bf25bf@dotenv.local/vault/.env.vault?environment=production', env('DOTENV_KEY'));
        $this->assertEmpty(env('DOTENV_VAULT_DEVELOPMENT'));
        $this->assertEmpty(env('DOTENV_VAULT_PRODUCTION'));
        $this->assertEmpty(env('APP_ENV'));
        $this->assertEmpty(env('APP_KEY'));
    }
}
