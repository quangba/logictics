<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Carrier.
 *
 * @package namespace App\Entities;
 */
class Carrier extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'carriers';
    protected $fillable = [
        'id','carrier', 'pic', 'pol', 'pod', 'effective_date', 'expired_date', 'freight', 'freight_note', 'frequency', 'transit_time', 'remarks', 'input_user', 'editor'
    ];

}
