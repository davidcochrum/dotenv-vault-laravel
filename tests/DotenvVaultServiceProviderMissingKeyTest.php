<?php

namespace DotenvVault\Laravel\Tests;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderMissingKeyTest extends TestCase
{
    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/missing_key';
    }

    public function test(): void
    {
        $this->assertEmpty(env('DOTENV_KEY'));
        $this->assertSame('Ia8Wl18hbLspW3viKy50DLvoImeEWwC2XvrTR0VNjws6KDItwxLKShxEdLU/Tz/eX4OBHBOTYq5p4ZWHIOiHxaWLjBejJqZS3Q==', env('DOTENV_VAULT_DEVELOPMENT'));
        $this->assertSame('LnTGTrcgMESVJ4etJGMh6vTTPLvIr/fhfM1Ed9t6G/y8QgkRMlT07PLeGnhctSngJKBlgBpfxObUcBwlA2BGnLmJYY5yc5+9xrXMano=', env('DOTENV_VAULT_PRODUCTION'));
        $this->assertEmpty(env('APP_ENV'));
        $this->assertEmpty(env('APP_KEY'));
    }
}
