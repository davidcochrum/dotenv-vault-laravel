<?php

namespace DotenvVault\Laravel\Tests;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderCustomTest extends TestCase
{
    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/custom';
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
        $this->assertSame('development', env('APP_ENV'));
        $this->assertSame('super-secret-key', env('APP_KEY'));
    }
}
