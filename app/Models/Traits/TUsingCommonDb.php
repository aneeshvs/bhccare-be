<?php
namespace App\Models\Traits;

trait TUsingCommonDb
{
    protected static function init(): string 
    {
        return 'common';
    }
}