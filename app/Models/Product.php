<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'qty',
        'category_id',
        'description',
        'keyword'
    ];

    public function getImage()
    {
        $imagePath = 'uploads/no-image.png';
        $images = $this->productimages()->where('status', 1)->orderBy('created_at', 'desc')->take(1)->get();
        if ($images) {
            foreach ($images as $image) {
                $imagePath = $image->image;
            }
        }
        return '/storage/' . $imagePath;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('productName', 'productImage', 'productQty', 'productPrice', 'ProductAmount');
    }

    public function productimages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
