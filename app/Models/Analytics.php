<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'electricity_amount_due',
        'water_amount_due',
        'rent_amount',
        'overall_due',
        'paid_status',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function calculateOverallDue()
    {
        $this->overall_due = $this->electricity_amount_due + $this->water_amount_due + $this->rent_amount;
        $this->paid_status = $this->paid_status === 'paid' ? 'paid' : 'unpaid';
        $this->save();
    }
}
