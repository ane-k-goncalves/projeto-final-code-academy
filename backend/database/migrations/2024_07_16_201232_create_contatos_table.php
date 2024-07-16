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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('position');
            $table->unsignedBigInteger('etapa_id');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->date('data_de_nascimento');
            $table->string('endereco');
            $table->double('valor');
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
