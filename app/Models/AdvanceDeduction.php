<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceDeduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'advance_id',
        'amount',
        'deduction_date',
        'payroll_period',
        'status',
        'processed_by'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'deduction_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function advance()
    {
        return $this->belongsTo(Advance::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
