<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderdetail', 'order_id', 'product_id');
    }
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->join('customers','customers.id','=','orders.customer_id')
            ->select('*')
           ->where('customers.name', 'like', '%' . $key . '%')
           ->orWhere('customers.phone', 'like', '%' . $key . '%')
           ->orWhere('customers.email', 'like', '%' . $key . '%')
           ->orWhere('customers.address', 'like', '%' . $key . '%');
        }
        return $query;
    }
}
