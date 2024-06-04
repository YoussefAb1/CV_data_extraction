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
        Schema::create('coproprietaire_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coproprietaire_id');
            $table->unsignedBigInteger('appartement_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->foreign('coproprietaire_id')->references('id')->on('member_coproprietaires')->onDelete('cascade');
            $table->foreign('appartement_id')->references('id')->on('appartements')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coproprietaire_histories');
    }
};
