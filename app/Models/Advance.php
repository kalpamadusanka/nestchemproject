<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'reason',
        'status',
        'deduction_start_date',
        'monthly_deduction',
        'total_deducted',
        'processed_by',
        'processed_at',
        'completed_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'monthly_deduction' => 'decimal:2',
        'total_deducted' => 'decimal:2',
        'deduction_start_date' => 'date',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function deductions()
    {
        return $this->hasMany(AdvanceDeduction::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function getRemainingBalanceAttribute()
    {
        return $this->amount - $this->total_deducted;
    }

    public function getProgressPercentageAttribute()
    {
        return $this->amount > 0 ? ($this->total_deducted / $this->amount) * 100 : 0;
    }
}
