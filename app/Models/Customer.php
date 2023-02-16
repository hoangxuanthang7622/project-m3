<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table ='customers';
    protected $fillable = [
        'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',

    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->join('orders','customers.id','=','orders.customer_id')
            ->select('*')
           ->where('customers.name', 'like', '%' . $key . '%')
           ->orWhere('customers.phone', 'like', '%' . $key . '%')
           ->orWhere('customers.email', 'like', '%' . $key . '%')
           ->orWhere('customers.address', 'like', '%' . $key . '%');
        }
        return $query;
    }
}
