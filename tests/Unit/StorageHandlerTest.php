<?php


namespace PowerLabs-NZ\EloquentEncryption\Tests\Unit;

use Illuminate\Support\Facades\Storage;
use PowerLabs-NZ\EloquentEncryption\Contracts\RsaKeyHandler;
use PowerLabs-NZ\EloquentEncryption\EloquentEncryption;
use PowerLabs-NZ\EloquentEncryption\Exceptions\RSAKeyFileMissing;
use PowerLabs-NZ\EloquentEncryption\FileSystem\RsaKeyStorageHandler;
use PowerLabs-NZ\EloquentEncryption\Tests\TestCase;
use PowerLabs-NZ\EloquentEncryption\Tests\Traits\WithRSAHelpers;

class StorageHandlerTest extends TestCase
{
    use WithRSAHelpers;


    /**
     * @var RsaKeyHandler
     */
    private $handler;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake();

        $this->handler = new RsaKeyStorageHandler();
    }

    /** @test */
    function if_a_public_key_is_missing_an_error_is_thrown()
    {
        $this->expectException(RSAKeyFileMissing::class);
        $this->expectExceptionObject(new RSAKeyFileMissing);
        $this->handler->getPublicKey();
    }

    /** @test */
    function if_a_private_key_is_missing_an_error_is_thrown()
    {
        $this->expectException(RSAKeyFileMissing::class);
        $this->expectExceptionObject(new RSAKeyFileMissing);
        $this->handler->getPrivateKey();
    }

    /** @test */
    function if_both_key_parts_are_missing_exists_returns_false()
    {
        $this->assertFalse($this->handler->exists());
    }

    /** @test */
    function if_public_key_missing_exists_returns_false()
    {
        $this->makePrivateKey();

        $this->assertFalse($this->handler->exists());
    }

    /** @test */
    function if_private_key_missing_exists_returns_false()
    {
        $this->makePublicKey();

        $this->assertFalse($this->handler->exists());
    }

    /** @test */
    function if_public_and_private_keys_exists_returns_true()
    {
        $this->makePublicKey();
        $this->makePrivateKey();

        $this->assertTrue($this->handler->exists());
    }
}
