<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform_post extends Model
{
    /** @use HasFactory<\Database\Factories\PostPlatformFactory> */
    use HasFactory;
    protected $fillable = [
        'platform_status',
        'post_id',
        'platform_id'

    ];
}
