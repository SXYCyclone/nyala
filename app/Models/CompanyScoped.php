<?php

namespace App\Models;

trait CompanyScoped
{
    protected static function bootCompanyScoped()
    {
        if (auth()->check() && auth()->user()->currentCompany) {
            static::addGlobalScope('company', function ($builder) {
                $builder->where('company_id', auth()->user()->currentCompany->id);
            });

            static::creating(function ($model) {
                if (!isset($model->company_id)) {
                    $model->company_id = auth()->user()->currentCompany->id;
                }
            });
        }
    }
}
