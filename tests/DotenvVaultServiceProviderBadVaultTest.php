<?php

namespace DotenvVault\Laravel\Tests;

use Throwable;

/** @covers \DotenvVault\Laravel\DotenvVaultServiceProvider */
class DotenvVaultServiceProviderBadVaultTest extends TestCase
{
    /** @var Throwable|null */
    private $exception;

    protected function getFixturePath()
    {
        return __DIR__ . '/fixtures/bad_vault';
    }

    protected function setUp(): void
    {
        try {
            $this->exception = null;
            parent::setUp();
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    public function test(): void
    {
        $this->assertInstanceOf(Throwable::class, $this->exception);
        $this->assertStringContainsString('Decrypter.php', $this->exception->getFile());
        $this->assertSame('dotenv://:key_e3405d44ee2213b42a7e393881e06588d84f06474923e5a11ffe4db282bf25bf@dotenv.local/vault/.env.vault?environment=production', env('DOTENV_KEY'));
        $this->assertEmpty(env('APP_ENV'));
        $this->assertEmpty(env('APP_KEY'));
    }
}
