<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDimension extends Model
{
    use HasFactory;

    protected $table = 'product_dimensions';

    protected $fillable = [
        'product_id',
        'net_weight',
        'gross_weight',
        'height',
        'width',
        'depth',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
