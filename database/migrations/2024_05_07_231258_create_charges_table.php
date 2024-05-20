<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->string('type');
            $table->date('date');
            $table->decimal('montant', 10, 2);
            $table->text('description')->nullable();
            $table->string('statut');
            $table->foreignId('appartement_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('immeuble_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('residence_id')->nullable()->constrained()->onDelete('cascade');
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
}
