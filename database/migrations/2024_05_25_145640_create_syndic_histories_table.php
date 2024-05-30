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
        Schema::create('syndic_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('syndic_id');
            $table->unsignedBigInteger('immeuble_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->foreign('syndic_id')->references('id')->on('member_syndics')->onDelete('cascade');
            $table->foreign('immeuble_id')->references('id')->on('immeubles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syndic_histories');
    }
};
