<?php

namespace App\Domains\Receipt\Commands;

use App\Domains\Receipt\Jobs\CheckForNewReceiptsJob;
use Illuminate\Console\Command;

class CheckForNewReceiptsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receipt:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new receipts in the tenant database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        CheckForNewReceiptsJob::dispatch();

        return Command::SUCCESS;
    }
}
