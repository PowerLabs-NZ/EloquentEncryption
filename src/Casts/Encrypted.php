<?php


namespace PowerLabs\EloquentEncryption\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use PowerLabs\EloquentEncryption\EloquentEncryptionFacade;

class Encrypted implements CastsAttributes
{
    /**
     * Cast the given value and decrypt
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        if(is_null($value)){
            return null;
        }

        return EloquentEncryptionFacade::decryptString($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        if(is_null($value)){
            return null;
        }

        return EloquentEncryptionFacade::encryptString($value);
    }
}
