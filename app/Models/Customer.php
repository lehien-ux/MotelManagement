<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $primaryKey = "id";
    protected $table ="customers";

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
