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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['fisica', 'juridica']);
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('full_name');
            $table->string('fantasy_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('registration_code');
            $table->string('state_registration')->nullable();
            $table->string('municipal_registration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
