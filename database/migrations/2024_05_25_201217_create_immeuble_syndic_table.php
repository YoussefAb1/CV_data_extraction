<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmeubleSyndicTable extends Migration
{
    public function up()
    {
        Schema::create('immeuble_syndic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('immeuble_id')->constrained()->onDelete('cascade');
            $table->foreignId('member_syndic_id')->constrained('member_syndics')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('immeuble_syndic');
    }
}

