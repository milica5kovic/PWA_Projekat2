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
        Schema::create('predmet_korpes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korpa_id');
            $table->foreignId('proizvod_id');;
            $table->integer('kolicina');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predmet_korpes');
    }
};
