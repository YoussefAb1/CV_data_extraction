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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture')->unique();
            $table->date('date_emission');
            $table->date('date_echeance');
            $table->float('montant_total');
            $table->text('description')->nullable();
             $table->foreignId('id_appartement')->constrained('appartements');
            $table->foreignId('id_charge')->constrained('charges');
            $table->enum('etat', ['Payee', 'Partiellement payee', 'En attente de paiement', 'Annulee'])->default('En attente de paiement');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
