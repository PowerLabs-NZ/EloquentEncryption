<?php


namespace PowerLabs\EloquentEncryption\Tests\Unit;


use Illuminate\Foundation\Auth\User;
use PowerLabs\EloquentEncryption\Casts\EncryptedInteger;
use PowerLabs\EloquentEncryption\EloquentEncryptionFacade;
use PowerLabs\EloquentEncryption\Tests\TestCase;

class EncryptedIntegerCastTest extends TestCase
{
    /** @test */
    function encrypted_integer_cast_decrypts_values()
    {
        EloquentEncryptionFacade::shouldReceive('exists')
            ->andReturn(true)
            ->shouldReceive('decryptString')
            ->with('001100110011')
            ->andReturn('001100110011');

        $cast = new EncryptedInteger();
        $user = new User();

        $response = $cast->get($user, 'encrypted', '001100110011', []);

        $this->assertIsInt($response);
        $this->assertEquals(1100110011, $response);
    }

    /** @test */
    function encrypted_integer_cast_encrypts_values()
    {
        EloquentEncryptionFacade::partialMock()
            ->shouldReceive('exists')
            ->andReturn(true)
            ->shouldReceive('encryptString')
            ->with(110011001100)
            ->andReturn('001100110011');

        $cast = new EncryptedInteger();
        $user = new User();

        $this->assertEquals('001100110011', $cast->set($user, 'encrypted', 110011001100, []));
    }
}
