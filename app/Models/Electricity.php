<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Electricity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "electricity"; // Define the table name explicitly if it's different from the default convention

    protected $fillable = [
        'tenant_id',
        'date',
        'kwh',
        'amount_per_kwh',
        'amount_due'
    ];

    // Define the relationship with the Tenant model
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
