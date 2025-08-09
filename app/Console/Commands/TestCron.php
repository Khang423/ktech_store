<?php

namespace App\Console\Commands;

use App\Models\StockImportDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCron extends Command
{
    protected $signature = 'test:cron';
    protected $description = 'Test xem cron có chạy không';

    public function handle()
    {

    }
}
