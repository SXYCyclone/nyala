<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected static function boot()
    {
        parent::boot();

        if (method_exists('self', 'bootCompanyScoped')) {
            self::bootCompanyScoped();
        }
    }
}
