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
        Schema::create('responden', function (Blueprint $table) {
            $table->id('id_respon');
            $table->foreignId('id_kuesioner')->constrained('kuesioner', 'id_kuesioner')->onDelete('cascade');
            $table->string('identitas1')->nullable();
            $table->string('identitas2')->nullable();
            $table->string('identitas3')->nullable();
            $table->string('identitas4')->nullable();
            $table->string('identitas5')->nullable();
            $table->string('fingerprint')->nullable();
            $table->timestamp('waktu_submit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responden');
    }
};
