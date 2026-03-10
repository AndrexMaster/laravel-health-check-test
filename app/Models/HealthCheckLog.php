<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthCheckLog extends Model
{
    protected $fillable = ['owner_uuid', 'db', 'cache'];
}
