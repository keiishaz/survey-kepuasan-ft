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
        Schema::create('konfigurasi_identitas', function (Blueprint $table) {
            $table->id('id_konfigurasi');
            $table->foreignId('id_kuesioner')->constrained('kuesioner', 'id_kuesioner')->onDelete('cascade');
            $table->foreignId('id_admin')->constrained('admin', 'id_admin')->onDelete('cascade');
            $table->string('atribut1')->nullable();
            $table->string('atribut2')->nullable();
            $table->string('atribut3')->nullable();
            $table->string('atribut4')->nullable();
            $table->string('atribut5')->nullable();
            $table->boolean('wajib1')->default(false);
            $table->boolean('wajib2')->default(false);
            $table->boolean('wajib3')->default(false);
            $table->boolean('wajib4')->default(false);
            $table->boolean('wajib5')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_identitas');
    }
};
