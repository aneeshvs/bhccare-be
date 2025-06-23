<?php
namespace App\Models\Traits;

trait TUsingSiteDb
{
    protected static function init():string{
        return 'site';
    }
}