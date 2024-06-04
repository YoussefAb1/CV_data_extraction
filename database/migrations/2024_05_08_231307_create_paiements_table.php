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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 10, 2);
            $table->date('date_paiement');
            $table->string('methode_paiement');
            $table->unsignedBigInteger('coproprietaire_history_id')->nullable();
            $table->unsignedBigInteger('syndic_history_id')->nullable();
            $table->unsignedBigInteger('cotisation_id');
            $table->timestamps();

            $table->foreign('coproprietaire_history_id')->references('id')->on('coproprietaire_histories')->onDelete('set null');
            $table->foreign('syndic_history_id')->references('id')->on('syndic_histories')->onDelete('set null');
            $table->foreign('cotisation_id')->references('id')->on('cotisations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
