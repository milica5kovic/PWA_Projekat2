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
        Schema::create('porudzbinas', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('korpa_id');
            $table->string('ulica');
            $table->string('broj');
            $table->string('grad');
            $table->string('posta');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('porudzbines');
    }
};
