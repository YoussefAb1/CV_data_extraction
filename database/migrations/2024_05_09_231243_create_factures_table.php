<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
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
            $table->decimal('montant_total', 10, 2);
            $table->text('description')->nullable();
            $table->foreignId('paiement_id')->constrained()->onDelete('cascade');
            $table->foreignId('appartement_id')->constrained()->onDelete('cascade');
            $table->foreignId('member_coproprietaire_id')->constrained('member_coproprietaires')->onDelete('cascade');
            $table->foreignId('member_syndic_id')->constrained('member_syndics')->onDelete('cascade');
            $table->foreignId('charge_id')->constrained()->onDelete('cascade');
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
}
