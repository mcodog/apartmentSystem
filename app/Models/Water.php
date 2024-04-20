<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Water extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "water"; // Define the table name explicitly if it's different from the default convention

    protected $fillable = [
        'tenant_id',
        'date',
        'total_head',
        'amount_per_head',
        'amount_due'
    ];

    // Define the relationship with the Tenant model
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
