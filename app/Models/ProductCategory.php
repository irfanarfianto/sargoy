<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategory extends Pivot
{
    use HasFactory;

    protected $fillable = ['product_id', 'category_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
    