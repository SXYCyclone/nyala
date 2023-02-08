<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Role extends Model implements Sortable
{
    use HasFactory;
    use BelongsToCompany;
    use SortableTrait;
    use CompanyScoped;

    protected $fillable = [
        'key',
        'name',
        'description',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public array $sortable = [
        'order_column_name' => 'level',
        'sort_when_creating' => true,
    ];

    protected static function boot()
    {
        parent::boot();

        self::bootCompanyScoped();
    }
}
