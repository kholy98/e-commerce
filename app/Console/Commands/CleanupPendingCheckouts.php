<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupPendingCheckouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pending-checkouts:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired pending checkout records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = \App\Models\PendingCheckout::cleanupExpired();
        $this->info("Cleaned up {$deleted} expired pending checkouts");
    }
}
