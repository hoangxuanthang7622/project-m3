<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->join('categories','categories.id','=','products.category_id')
            ->select('*')
           ->where('products.name', 'like', '%' . $key . '%')
           ->orWhere('products.category_id', 'like', '%' . $key . '%')
           ->orWhere('products.price', 'like', '%' . $key . '%')
           ->orWhere('products.quantity', 'like', '%' . $key . '%');
        }
        if ($key1 = request()->key1) {
            $query = $query->where('name', 'like', '%' . $key1 . '%');
        }
        return $query;
    }
}
