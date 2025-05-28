<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class PublishScheduledPosts implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $posts = Post::where('status','scheduled')
        ->where('scheduled_time','>=',now())->get();
    }
}
