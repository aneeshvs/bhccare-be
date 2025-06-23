<?php
namespace App\Models\Traits;

trait TJWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return $this->resolveCustomClaim();
    }

    protected function resolveCustomClaim():array
    {
        $customClaim = [];

        if (static::class=== User::class)
        {
            return $customClaim;
        }
        try {
            $customClaim = [
                'site_identifier' => app('CURRENT_SITE_MODEL')->identifier,
        
            ];
        }catch(\Exception $exception) {
            abort(403,'Claim could not be resolved,');
        }
        return $customClaim;
    }

}