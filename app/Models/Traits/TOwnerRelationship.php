<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait TOwnerRelationship
{
    public function owner(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'owner_type', 'owner_id');
    }
}
