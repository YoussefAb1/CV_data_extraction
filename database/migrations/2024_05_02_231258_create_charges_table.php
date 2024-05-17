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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->unique();
            $table->date('date');
            $table->float('montant');
            $table->text('description')->nullable();
            $table->string('type');
            $table->enum('statut', ['Payee', 'Partiellement payee', 'En attente de paiement', 'En retard'])->default('En attente de paiement');

            $table->foreignId('id_appartement')->constrained('appartements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
    }
};
