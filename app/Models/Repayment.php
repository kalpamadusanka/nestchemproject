<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
  use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'due_date',
        'paid_date',
        'status',
        'payment_method',
        'transaction_reference',
        'late_fee',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'late_fee' => 'decimal:2',
        'due_date' => 'date',
        'paid_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'pending')
                    ->where('due_date', '<', Carbon::now());
    }

    public function scopeDueThisWeek($query)
    {
        return $query->where('status', 'pending')
                    ->whereBetween('due_date', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
    }

    public function getIsOverdueAttribute()
    {
        return $this->status === 'pending' && $this->due_date->isPast();
    }

    public function getDaysOverdueAttribute()
    {
        if (!$this->is_overdue) {
            return 0;
        }
        return Carbon::now()->diffInDays($this->due_date);
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'paid':
                return 'success';
            case 'pending':
                return $this->is_overdue ? 'danger' : 'warning';
            default:
                return 'secondary';
        }
    }
}
