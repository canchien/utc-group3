<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'keyword'
    ];

    protected $table = 'categories';
    
    public function products(){
        return $this->hasMany(Product::class);
    }
}
