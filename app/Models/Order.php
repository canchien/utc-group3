<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('productName','productImage','productQty','productPrice','ProductAmount');
    }

    public function orderStatuses() {
        return $this->hasMany(OrderStatuses::class)->orderBy('created_at','desc');
    }
}
