<?php

namespace DotenvVault\Laravel\Tests;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderDefaultTest extends TestCase
{
    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/default';
    }

    public function test(): void
    {
        $this->assertSame('dotenv://:key_e3405d44ee2213b42a7e393881e06588d84f06474923e5a11ffe4db282bf25bf@dotenv.local/vault/.env.vault?environment=production', env('DOTENV_KEY'));
        $this->assertSame('production', env('APP_ENV'));
        $this->assertSame('production-secret-key', env('APP_KEY'));
    }
}
