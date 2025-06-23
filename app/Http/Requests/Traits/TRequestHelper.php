<?php

namespace App\Http\Requests\Traits;

use Illuminate\Support\Collection;

trait TRequestHelper
{
    protected function set(string                                           $column,
                            array|bool|callable|Collection|int|float|string $value): static
    {
        $this->merge([
            $column => is_callable($value) ? $value($this->input($column)) : $value,
        ]);
        return $this;
    }
}
