<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 10, 2);
            $table->date('date_cotisation');
            $table->text('description')->nullable();
            $table->foreignId('appartement_id')->constrained()->onDelete('cascade');
            $table->foreignId('member_coproprietaire_id')->constrained('member_coproprietaires')->onDelete('cascade');
            $table->foreignId('member_syndic_id')->constrained('member_syndics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
}
