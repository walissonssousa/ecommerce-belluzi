<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Um produto pertence a uma marca
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
