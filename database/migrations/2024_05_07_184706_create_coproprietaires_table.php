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
        Schema::create('coproprietaires', function (Blueprint $table) {
            $table->string('prenom');
            $table->string('cin');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['promoteur', 'proprietaire', 'locataire']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coproprietaires');
    }
};
