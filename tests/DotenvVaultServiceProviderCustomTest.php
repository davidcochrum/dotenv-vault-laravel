<?php

namespace DotenvVault\Laravel\Tests;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderCustomTest extends TestCase
{
    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/custom';
    }

    protected function getVaultName(): string
    {
        return '.env.custom_vault';
    }

    protected function getKeyName(): string
    {
        return 'custom_key.env';
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test(): void
    {
        $this->assertSame('dotenv://:key_bf574d88b096bd072611330394f3e37e778a1724074efe4e92b7c9a49ad4017a@dotenv.local/vault/.env.vault?environment=development', env('DOTENV_KEY'));
        $this->assertSame('Ia8Wl18hbLspW3viKy50DLvoImeEWwC2XvrTR0VNjws6KDItwxLKShxEdLU/Tz/eX4OBHBOTYq5p4ZWHIOiHxaWLjBejJqZS3Q==', env('DOTENV_VAULT_DEVELOPMENT'));
        $this->assertSame('LnTGTrcgMESVJ4etJGMh6vTTPLvIr/fhfM1Ed9t6G/y8QgkRMlT07PLeGnhctSngJKBlgBpfxObUcBwlA2BGnLmJYY5yc5+9xrXMano=', env('DOTENV_VAULT_PRODUCTION'));
        $this->assertSame('development', env('APP_ENV'));
        $this->assertSame('super-secret-key', env('APP_KEY'));
    }
}
