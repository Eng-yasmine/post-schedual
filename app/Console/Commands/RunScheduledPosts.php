<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Console\Command;
use App\Jobs\PublishScheduledPosts;

class RunScheduledPosts extends Command
{
    protected $signature = 'app:run-scheduled-posts';
    protected $description = 'Run and dispatch jobs to publish scheduled posts';

    public function handle()
    {
        $now = Carbon::now();

        $posts = Post::where('status', 'schedualed')
            ->where('schedualed_time', '<=', $now)
            ->with('platforms') // assuming the relationship exists
            ->get();

        foreach ($posts as $post) {
            PublishScheduledPosts::dispatch($post);
        }

        $this->info(' All scheduled posts dispatched to the queue.');
    }
}
