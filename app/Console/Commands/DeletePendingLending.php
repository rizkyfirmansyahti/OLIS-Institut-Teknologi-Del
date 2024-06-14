<?php

namespace App\Console\Commands;

use App\Models\Lending;
use Illuminate\Console\Command;

class DeletePendingLending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-pending-lending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Lending with status pending after 24 hours of creation.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Lending::where('status', 'pending')->where('created_at', '<', now()->subDays(2))->delete();
    }
}
