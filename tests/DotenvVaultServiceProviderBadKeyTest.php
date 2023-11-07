<?php

namespace DotenvVault\Laravel\Tests;

use Exception;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderBadKeyTest extends TestCase
{
    /** @var Exception|null */
    private $exception;

    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/bad_key';
    }

    protected function setUp(): void
    {
        try {
            $this->exception = null;
            parent::setUp();
        } catch (Exception $e) {
            $this->exception = $e;
        }
    }

    public function test(): void
    {
        $this->assertEquals(new Exception('DECRYPTION_FAILED: Please check your DOTENV_KEY'), $this->exception);
    }
}
