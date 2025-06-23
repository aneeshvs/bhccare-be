<?php

namespace App\Models\Traits;

trait TUsingDefaultDb
{
    protected static function init(): string
    {
        return 'default';

    }

}