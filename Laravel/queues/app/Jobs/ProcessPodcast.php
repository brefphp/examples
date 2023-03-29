<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $podcastId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Processing podcast ' . $this->podcastId);

        // Uncomment the line below to simulate an error
        // throw new Exception('The podcast cannot be processed');
    }
}
