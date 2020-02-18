<?php

namespace RyanChandler\Shortlinks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use RyanChandler\Shortlinks\Destination;

class Shortlink extends Model
{
    use Concerns\HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'destination', 'prefix', 'track_clicks', 'clicks', 'track_ip', 'track_agent',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'track_clicks' => 'bool',
        'track_ip' => 'bool',
        'track_agent' => 'bool',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Shortlink $shortlink) {
            if (!$shortlink->prefix) {
                $shortlink->prefix = config('shortlinks.url_prefix');
            }
            
            $shortlink->destination = Str::start($shortlink->destination, 'http://');

            do {
                $exists = static::where('shortlink', $shortlinkString = Str::random(config('shortlinks.length')))->exists();
            } while ($exists);

            $shortlink->shortlink = $shortlinkString;
        });
    }

    /**
     * The tracking relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracking(): HasMany
    {
        return $this->hasMany(Tracking::class);
    }

    /**
     * Get the full shortlink URL.
     * 
     * @return string
     */
    public function fullUrl(): string
    {
        return url("/{$this->prefix}/{$this->shortlink}");
    }

    /**
     * Get the shortlink destination.
     * 
     * @return \RyanChandler\Shortlinks\Destination
     */
    public function destination(): Destination
    {
        return new Destination($this->destination);
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

    /**
     * Get the string representation of the Shortlink.
     * 
     * @return string
     */
    public function __toString(): string
    {
        return $this->fullUrl();
    }
}