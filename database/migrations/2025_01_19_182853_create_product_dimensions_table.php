<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_dimensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relacionamento com a tabela de produtos
            $table->decimal('net_weight', 8, 2);  // Peso líquido
            $table->decimal('gross_weight', 8, 2); // Peso bruto
            $table->decimal('height', 8, 2);      // Altura
            $table->decimal('width', 8, 2);       // Largura
            $table->decimal('depth', 8, 2);       // Profundidade
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_dimensions');
    }
};
