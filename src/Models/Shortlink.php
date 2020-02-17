<?php

namespace RyanChandler\Shortlinks\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlink extends Model
{
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