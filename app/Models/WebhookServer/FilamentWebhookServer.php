<?php

namespace Marjose123\FilamentWebhookServer\Models;

use App\Models\BaseModel;
use App\Models\CompanyScoped;

class FilamentWebhookServer extends BaseModel
{
    use CompanyScoped;

    protected $fillable = [
        'name',
        'description',
        'url',
        'method',
        'model',
        'header',
        'data_option',
        'verifySsl',
        'status',
        'events',
    ];

    protected $casts = [
        'header' => 'array',
        'events' => 'array',
    ];

    public function transactionlogs()
    {
        return $this->hasMany(FilamentWebhookServerHistory::class, 'webhook_client', 'id');
    }
}
