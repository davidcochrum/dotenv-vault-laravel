<?php

namespace DotenvVault\Laravel\Tests;

use Exception;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderBadKeyTest extends TestCase
{
    /** @var Exception|null */
    private $exception = null;

    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/bad_key';
    }

    protected function setUp(): void
    {
        try {
            parent::setUp();
        } catch (Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test(): void
    {
        $this->assertEquals(new Exception('INVALID_DOTENV_KEY: Key must be valid.'), $this->exception);
    }
}
