<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\Materialstock;
use App\Models\Poitems;
use App\Models\Purchaseorder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class Receivedstockexp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:receivedstockexp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Current stock expire date check';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stock=Materialstock::where('status',1)->get();
        $today = now()->toDateString();
        foreach ($stock as $s) {

                $existingNotification = DB::table('notifications')
                ->whereDate('created_at', $today)
                ->where('notifiable_id', $s->id)
                ->where('type', 'expired stock')
                ->exists();

            // Insert notification only if it does not already exist
            if (!$existingNotification) {
                DB::table('notifications')->insert([
                    'id' => Str::uuid(),
                    'type' => 'expired received stock',
                    'notifiable_id' => $s->material_id,
                    'notifiable_type' => 'App\Models\Material',
                    'data' => json_encode([
                        'message' => 'Material has expired',
                        'id' => $s->material_id,
                        'lot_id' => $s->lot, // Assuming 'lot_id' exists in the Material model
                        'batch_id' => $s->batch, // Assuming 'batch_id' exists in the Material model
                    ]),
                    'read_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


            // Check if a notification for this material already exists today

        }
    }
}
