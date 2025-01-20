<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContact extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'email', 'facebook', 'instagram', 'phone', 'whatsapp', 'contact_name'];

    // O contato pertence a um fornecedor
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}