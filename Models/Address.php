<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressable_id', 'addressable_type', 'type', 'cep', 'number', 
        'street', 'complement', 'neighborhood', 'state', 'city'
    ];

    // O endereço pode ser para um fornecedor ou cliente
    public function addressable()
    {
        return $this->morphTo();
    }
}