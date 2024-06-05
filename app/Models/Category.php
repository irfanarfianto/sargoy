<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'images', 'position',
        'meta_keyword',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }
}
