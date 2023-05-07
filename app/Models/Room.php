<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['*'];

    protected $table = 'rooms';

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_rooms');
    }

    public function contractTransplant()
    {
        return $this->hasOne(Contract::class);
    }

}
