<?php

namespace DotenvVault\Laravel\Tests;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderDefaultTest extends TestCase
{
    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/default';
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test(): void
    {
        $this->assertSame('dotenv://:key_e3405d44ee2213b42a7e393881e06588d84f06474923e5a11ffe4db282bf25bf@dotenv.local/vault/.env.vault?environment=production', env('DOTENV_KEY'));
        $this->assertSame('Ia8Wl18hbLspW3viKy50DLvoImeEWwC2XvrTR0VNjws6KDItwxLKShxEdLU/Tz/eX4OBHBOTYq5p4ZWHIOiHxaWLjBejJqZS3Q==', env('DOTENV_VAULT_DEVELOPMENT'));
        $this->assertSame('LnTGTrcgMESVJ4etJGMh6vTTPLvIr/fhfM1Ed9t6G/y8QgkRMlT07PLeGnhctSngJKBlgBpfxObUcBwlA2BGnLmJYY5yc5+9xrXMano=', env('DOTENV_VAULT_PRODUCTION'));
        $this->assertSame('production', env('APP_ENV'));
        $this->assertSame('production-secret-key', env('APP_KEY'));
    }
}
