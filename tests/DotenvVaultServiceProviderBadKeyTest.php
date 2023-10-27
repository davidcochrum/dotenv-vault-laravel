<?php

namespace DotenvVault\Laravel\Tests;

use DotenvVault\DotEnvVaultError;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderBadKeyTest extends TestCase
{
    /** @var DotEnvVaultError|null */
    private $exception = null;

    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/bad_key';
    }

    protected function setUp(): void
    {
        try {
            parent::setUp();
        } catch (DotEnvVaultError $e) {
            $this->exception = $e;
        }
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test(): void
    {
        $this->assertEquals(new DotEnvVaultError('INVALID_DOTENV_KEY: Key must be valid.'), $this->exception);
    }
}
