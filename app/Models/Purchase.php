<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_name',
        'description',
        'amount',
        'type',
        'purchase_date',
        'invoice_number',
        'supplier',
        'assigned_to',
        'status',
        'notes'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    public function getFormattedAmountAttribute()
    {
        return 'RM ' . number_format($this->amount, 2);
    }
} 