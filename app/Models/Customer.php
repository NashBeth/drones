<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customer_details';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'city', 'country', 'company_name', 'town', 'district', 'order_id', 'product_id', 'quantity', 'price'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
