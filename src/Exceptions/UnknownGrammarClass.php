<?php


namespace PowerLabs-NZ\EloquentEncryption\Exceptions;


class UnknownGrammarClass extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Unknown Grammar Class, unable to define Encrypted Type. Use Binary instead';
}
