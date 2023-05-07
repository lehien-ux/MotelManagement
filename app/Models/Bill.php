<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id', 'status', 'customer_id', 'deposited', 'month', 'total_price', 'payment_at', 'start_date', 'end_date'
    ];

    protected $table = 'bills';

    public function detailBills()
    {
        return $this->hasMany(DetailBill::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
