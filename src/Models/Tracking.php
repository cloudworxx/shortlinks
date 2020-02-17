<?php

namespace RyanChandler\Shortlinks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tracking extends Model
{
    use Concerns\HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address', 'agent',
    ];

    /**
     * The shortlink relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shortlink(): BelongsTo
    {
        return $this->belongsTo(Shortlink::class);
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('shortlinks.database_table_prefix').'tracking';
    }
}