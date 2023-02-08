<?php

namespace App\Models;

trait CompanyScoped
{
    protected static function bootCompanyScoped()
    {
        static::addGlobalScope('company', function ($builder) {
            if ($c = auth()->user()?->currentCompany) {
                $builder->where('company_id', $c->id);
            }
        });

        static::creating(function ($model) {
            if (!isset($model->company_id) && ($c = auth()->user()?->currentCompany)) {
                $model->company_id = $c->id;
            }
        });
    }
}
