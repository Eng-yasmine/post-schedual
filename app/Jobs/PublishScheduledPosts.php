<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PublishScheduledPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle(): void
    {
        // Update post status
        $this->post->status = 'published';
        $this->post->save();

        Log::info(" Published Post ID: {$this->post->id} - Title: {$this->post->title}");

        // Update all platform statuses in pivot table
        if ($this->post->platforms()->exists()) {
            foreach ($this->post->platforms as $platform) {
                $this->post->platforms()->updateExistingPivot($platform->id, [
                    'platform_status' => 'published'
                ]);
                Log::info(" Platform ID {$platform->id} updated for Post ID {$this->post->id}");
            }
        }

        Log::info('Running scheduled posts command...');
    }
}
