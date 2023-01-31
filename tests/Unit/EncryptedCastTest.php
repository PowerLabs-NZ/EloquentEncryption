<?php


namespace PowerLabs-NZ\EloquentEncryption\Tests\Unit;


use Illuminate\Foundation\Auth\User;
use PowerLabs-NZ\EloquentEncryption\Casts\Encrypted;
use PowerLabs-NZ\EloquentEncryption\EloquentEncryptionFacade;
use PowerLabs-NZ\EloquentEncryption\Tests\TestCase;

class EncryptedCastTest extends TestCase
{
    /** @test */
    function encrypted_cast_decrypts_values()
    {
        EloquentEncryptionFacade::shouldReceive('exists')
            ->andReturn(true)
            ->shouldReceive('decryptString')
            ->with('001100110011')
            ->andReturn('test');

        $cast = new Encrypted();
        $user = new User();

        $this->assertEquals('test', $cast->get($user, 'encrypted', '001100110011', []));
    }

    /** @test */
    function encrypted_cast_encrypts_values()
    {
        EloquentEncryptionFacade::shouldReceive('exists')
            ->andReturn(true)
            ->shouldReceive('encryptString')
            ->with('test')
            ->andReturn('001100110011');

        $cast = new Encrypted();
        $user = new User();

        $this->assertEquals('001100110011', $cast->set($user, 'encrypted', 'test', []));
    }
}
