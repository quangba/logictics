<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ActivityLog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'activity_logs';
    protected $fillable = [
        'user_id', 'session_id', 'method', 'action', 'url',
        'affected_ids', 'data', 'ip_address', 'user_agent',
    ];

    protected $casts = [
        'data' => 'array',
        'location' => 'array',
    ];
}
