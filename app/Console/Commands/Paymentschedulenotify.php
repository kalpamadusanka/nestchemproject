<?php

namespace App\Console\Commands;

use App\Models\Notifypaymentschedule;
use App\Models\Schedulepayment;
use Illuminate\Console\Command;

class Paymentschedulenotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:paymentschedulenotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schedulepayment = Schedulepayment::where('status', 1)->get();
        $today = now()->toDateString();
        foreach ($schedulepayment as $s) {
            if ($s->date == $today) {
                // Check if a notification already exists for this schedule today
                $existingNotification = Notifypaymentschedule::where('payment_schedule_id', $s->id)
                    ->whereDate('created_at', $today)
                    ->where('status', 1)
                    ->first();

                if (!$existingNotification) {
                    $schedulePayment = new Notifypaymentschedule();
                    $schedulePayment->payment_schedule_id = $s->id;
                    $schedulePayment->save();
                }
            }
        }
    }
}
