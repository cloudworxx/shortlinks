<?php

namespace RyanChandler\Shortlinks\Models;

use Illuminate\Database\Eloquent\Model;

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
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('shortlinks.database_table_prefix').'tracking';
    }
}