<?php

namespace App\Console;

use App\Models\User;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $today = date('Y-m-d');
            $usersWithoutActivity = User::where('id', '!=', 1)
                ->whereDoesntHave('activityLogs', function ($query) use ($today) {
                    $query->whereDate('date', $today);
                })
                ->get();

            foreach ($usersWithoutActivity as $user) {
                Notification::send($user, new \App\Notifications\MissingActivityNotification());
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
