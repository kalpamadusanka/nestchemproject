<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Currentproductstock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:currentproductstock';

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
          $products=Product::where('status',1)->get();
        $today = now()->toDateString();
        foreach ($products as $s) {

            if($s->qty < $s->alert_qty){

                $existingNotification = DB::table('notifications')
                ->whereDate('created_at', $today)
                ->where('notifiable_id', $s->id)
                ->where('type', 'expired stock')
                ->exists();

            // Insert notification only if it does not already exist
            if (!$existingNotification) {
                DB::table('notifications')->insert([
                    'id' => Str::uuid(),
                    'type' => 'Low product stock',
                    'notifiable_id' => $s->id,
                    'notifiable_type' => 'App\Models\Product',
                    'data' => json_encode([
                        'message' => 'Low product stock',
                        'id' => $s->id,
                        'product_code' => $s->product_code, // Assuming 'lot_id' exists in the Material model
                         // Assuming 'batch_id' exists in the Material model
                    ]),
                    'read_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            }
            // Check if a notification for this material already exists today

        }
    }
}
