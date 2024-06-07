<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'images',
        'meta_keyword',
    ];

    protected static function boot()
    {
        parent::boot();

        static::factory(function ($category) {
            return new \Database\Factories\CategoryFactory();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category')
        ->using(ProductCategory::class)
            ->withTimestamps();
    }
}
