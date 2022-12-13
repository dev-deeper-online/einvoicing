<?php

namespace App\Domains\Feed\Jobs;

use App\Domains\Feed\Feed;
use App\Domains\Receipt\Contracts\CreatesNewReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckForNewReceiptsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @param  CreatesNewReceipt  $action
     * @return void
     */
    public function handle(CreatesNewReceipt $action): void
    {
        Feed::run()->each(fn (array $receipt) => $action->handle($receipt));
    }
}
