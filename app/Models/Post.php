<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'title',
        'content',
        'image',
        'status',
        'user_id',
        'scheduled_time'
    ];
    protected $casts = [
        'scheduled_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'platform_posts')
            ->withPivot('platform_status')
            ->withTimestamps();
    }
}
