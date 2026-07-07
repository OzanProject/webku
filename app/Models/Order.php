<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'order_type',
        'item_name',
        'status',
        'total_price',
        'notes',
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }
}
