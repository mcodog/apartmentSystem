<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Tenant extends Model
{
    use HasFactory;
    public $table = "tenants";

    public function getImage(){
        if($this->image){
            return url('storage/'. $this->image);
        }
        return URL::asset('storage/tenant/default-tenant.png');
    }
}
