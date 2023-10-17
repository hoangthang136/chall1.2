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
        Schema::create('submit_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('upload_file_nopbai');
            $table->string('tensv');
            $table->foreignId('sv_id')->references('id')->on('user');
            $table->foreignId('baitap_id')->references('id')->on('assignments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submit_assignments');
    }
};
