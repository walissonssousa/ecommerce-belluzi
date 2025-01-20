<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryControl extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'product_variation_id', 'stock_available', 'stock_min', 'stock_max'];

    // Um controle de estoque pode ser para um produto ou variação
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
