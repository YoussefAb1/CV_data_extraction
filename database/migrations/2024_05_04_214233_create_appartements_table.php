<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appartements', function (Blueprint $table) {

            $table->id();
            $table->string('nom_appartement');
            $table->string('etage');
            $table->string('surface');
            $table->foreignId('immeuble_id')->constrained()->onDelete('cascade');
            $table->foreignId('residence_id')->constrained()->onDelete('cascade');
<<<<<<< HEAD:database/migrations/2024_05_04_214233_create_appartements_table.php
=======
            $table->foreignId('member_coproprietaire_id')->nullable()->constrained('users')->onDelete('cascade'); // Utiliser la table 'users' ici

>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364:database/migrations/2024_05_06_214233_create_appartements_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartements');
    }
}
