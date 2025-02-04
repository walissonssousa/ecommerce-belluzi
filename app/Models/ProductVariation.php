<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'variation_type', 'variation_value', 'price', 'weight', 'dimensions', 'stock', 'sku', 'barcode', 'product_dimension_id'];

    // Uma variação pertence a um produto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Uma variação pode ter várias imagens
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // Controle de estoque para variação
    public function inventory()
    {
        return $this->hasOne(InventoryControl::class);
    }
}