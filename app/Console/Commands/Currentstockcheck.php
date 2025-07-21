<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\Materialstock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Currentstockcheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:currentstockcheck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stock correction';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $materialStocks = MaterialStock::where('status', 1)
        ->select('material_id', DB::raw('SUM(qty) as total_qty'))
        ->groupBy('material_id')
        ->get();

    // Log the fetched data
    Log::info('Material Stock Data:', $materialStocks->toArray());

        foreach ($materialStocks as $stock) {
            Material::where('id', $stock->material_id)
                ->update(['qty' => $stock->total_qty]);
        }
    }
}
