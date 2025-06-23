<?php

namespace App\Classes;

use Illuminate\Foundation\Http\FormRequest;

class ProtectedRequest
{

    private array $keys = [];
    private array $exceptKeys = [];
    private FormRequest $original;
    private FormRequest $protected;

    public function __construct(FormRequest $request, array|string $input = NULL)
    {
        $this->original  = $request;
        $this->protected = $request;

        if ($input !== NULL) {
            $this->only($input);
        }

        $this->exceptKeys = [];
    }

    public function original(): FormRequest
    {
        return $this->original;
    }

    public function protected(): FormRequest
    {
        return $this->protected;
    }

    public function except(array|string $key_or_keys): static
    {
        $this->protected = new FormRequest($this->protected->except(is_string($key_or_keys) ? [$key_or_keys] : $key_or_keys));

        return $this;
    }

    public static function make(FormRequest $request, array|string $key_or_keys = NULL): static
    {
        return (new static($request, $key_or_keys));
    }

    public function merge(array $input): static
    {
        $this->protected->merge($input);

        return $this;
    }

    public function mergeIfMissing(array $input): static
    {
        $this->protected->mergeIfMissing($input);

        return $this;
    }

    public function only(array|string $key_or_keys): static
    {
        $this->protected = new FormRequest($this->protected->only(is_string($key_or_keys) ? [$key_or_keys] : $key_or_keys));

        return $this;
    }

}
