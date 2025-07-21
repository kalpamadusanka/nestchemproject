<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_request_id',
        'amount',
        'type',
        'purpose',
        'repayment_months',
        'monthly_payment',
        'interest_rate',
        'status',
        'approved_at',
        'approved_by',
        'disbursed_at',
        'completed_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'approved_at' => 'datetime',
        'disbursed_at' => 'datetime',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanRequest()
    {
        return $this->belongsTo(LoanRequest::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeOverdue($query)
    {
        return $query->whereHas('repayments', function ($q) {
            $q->where('status', 'pending')
              ->where('due_date', '<', Carbon::now());
        });
    }

    public function getTotalPaidAttribute()
    {
        return $this->repayments()->where('status', 'paid')->sum('amount');
    }

    public function getRemainingBalanceAttribute()
    {
        return $this->amount - $this->total_paid;
    }

    public function getProgressPercentageAttribute()
    {
        return $this->amount > 0 ? ($this->total_paid / $this->amount) * 100 : 0;
    }
}
