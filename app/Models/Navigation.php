<?php

namespace App\Models;

class Navigation extends \RyanChandler\FilamentNavigation\Models\Navigation
{
    use CompanyScoped;
    use BelongsToCompany;

    protected static function boot()
    {
        parent::boot();

        self::bootCompanyScoped();
    }
}
