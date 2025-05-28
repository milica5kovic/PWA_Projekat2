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
        Schema::create('proizvods', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('kategorija_id');
            $table->string('ime');
            $table->text('opis');
            $table->decimal('cena', 10, 2);
            $table->string('slika')->nullable();
            $table->integer('stanje')->default(0);
            $table->boolean('oznaceno')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proizvods');
    }
};
