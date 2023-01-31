<?php


namespace PowerLabs\EloquentEncryption\Exceptions;


class RSAKeyFileMissing extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Eloquent Encryption RSA keys cannot be found.';
}
