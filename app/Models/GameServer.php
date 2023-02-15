<?php

namespace App\Models;

use App\Enums\GameServerProtocol;
use App\Enums\GameServerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameServer extends BaseModel
{
    use HasFactory;
    use CompanyScoped;

    protected $fillable = [
        'name',
        'type',
        'protocol',
        'config',
    ];

    protected $casts = [
        'type' => GameServerType::class,
        'protocol' => GameServerProtocol::class,
        'config' => 'array',
    ];
}
