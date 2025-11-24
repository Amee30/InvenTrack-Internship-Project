<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckTime extends Command
{
    protected $signature = 'time:check';
    protected $description = 'Check current time and timezone information';

    public function handle()
    {
        $this->info('=== Laravel Time Information ===');
        $this->line('');
        
        $now = Carbon::now();
        
        $this->table(
            ['Property', 'Value'],
            [
                ['Current DateTime', $now->toDateTimeString()],
                ['Date', $now->toDateString()],
                ['Time', $now->toTimeString()],
                ['Day', $now->format('l')],
                ['Timezone', $now->timezone->getName()],
                ['Config Timezone', config('app.timezone')],
                ['Timestamp', $now->timestamp],
                ['ISO 8601', $now->toIso8601String()],
            ]
        );

        $this->line('');
        
        // Database Time
        try {
            $dbTime = DB::select('SELECT NOW() as db_time')[0]->db_time;
            $this->info("Database Time: {$dbTime}");
            
            // Database Timezone
            $dbTimezone = DB::select('SELECT @@global.time_zone as global_tz, @@session.time_zone as session_tz')[0];
            $this->info("Database Global Timezone: {$dbTimezone->global_tz}");
            $this->info("Database Session Timezone: {$dbTimezone->session_tz}");
        } catch (\Exception $e) {
            $this->error("Cannot get database time: " . $e->getMessage());
        }

        return 0;
    }
}