<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'cpf', 'cnpj', 'full_name', 'fantasy_name', 
        'birth_date', 'registration_code', 'state_registration', 
        'municipal_registration'
    ];

    // Um fornecedor pode ter vários contatos
    public function contacts()
    {
        return $this->hasMany(SupplierContact::class);
    }

    // Um fornecedor pode ter vários endereços
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    // Um fornecedor pode fornecer vários produtos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
