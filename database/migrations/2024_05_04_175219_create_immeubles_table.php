<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmeublesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immeubles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_immeuble');
            $table->integer('nombre_etages');
            $table->foreignId('residence_id')->constrained()->onDelete('cascade');
<<<<<<< HEAD:database/migrations/2024_05_04_175219_create_immeubles_table.php
=======
            $table->foreignId('member_syndic_id')->constrained('users')->nullable()->onDelete('cascade');
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364:database/migrations/2024_05_05_175219_create_immeubles_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immeubles');
    }
}
