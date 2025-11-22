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
        // Create sections table
        Schema::create('sections', function (Blueprint $table) {
            $table->id('id_section');
            $table->foreignId('id_kuesioner')->constrained('kuesioner', 'id_kuesioner')->onDelete('cascade');
            $table->string('judul');
            $table->integer('urutan')->nullable();
            $table->timestamps();
        });

        // Add id_section column to pertanyaan table and make it reference to sections
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_section')->nullable()->after('id_kuesioner');
            $table->foreign('id_section')->references('id_section')->on('sections')->onDelete('set null');
        });

        // Drop the section string column
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->dropColumn('section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the section column
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->string('section')->nullable()->after('id_kuesioner');
        });

        // Remove the id_section column and foreign key
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->dropForeign(['id_section']);
            $table->dropColumn('id_section');
        });

        // Drop the sections table
        Schema::dropIfExists('sections');
    }
};
