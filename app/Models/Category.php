<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'images',
        'meta_keyword',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate slug if not provided
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->category_name);
            }
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category')
            ->using(ProductCategory::class)
            ->withTimestamps();
    }
}
