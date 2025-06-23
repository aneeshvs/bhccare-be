<?php
namespace App\Models\Classes;

use App\Models\Status;
use App\Models\Traits\TUsingDefaultDb;
use App\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DefaultDBModel extends BaseDBModel
{
    use TUsingDefaultDb;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'status_id',
        'owner_id',
        'owner_type'
    ];

        /**
     * Get the post that owns the comment.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
