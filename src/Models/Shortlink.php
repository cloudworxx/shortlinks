<?php

namespace RyanChandler\Shortlinks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shortlink extends Model
{
    use Concerns\HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'click_tracking', 'clicks', 'ip_tracking', 'agent_tracking',
    ];
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Shortlink $shortlink) {
            $shortlink->prefix = config('shortlinks.url_prefix');
            
            do {
                $exists = static::where('shortlink', $shortlinkString = Str::random(config('shortlinks.length')))->exists();
            } while ($exists);

            $shortlink->shortlink = $shortlinkString;
        });
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('shortlinks.database_table_prefix').'shortlinks';
    }
}