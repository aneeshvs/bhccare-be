<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait TTranslationCasts
{
    public function setLanguageCodeAttribute($value): void 
    {
        $this->attributes['language_code'] = Str::lower($value);
    }
}