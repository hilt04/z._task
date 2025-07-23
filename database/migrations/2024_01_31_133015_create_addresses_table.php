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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->string('logradouro');
            $table->string('numero', 20);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('complemento', 50)->nullable();
            $table->char('cep', 8);
            $table->char('estado', 2);

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
