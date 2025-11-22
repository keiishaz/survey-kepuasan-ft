<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set all existing status_manual values to NULL so they use automatic logic by default
        DB::table('kuesioner')->update(['status_manual' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed as the status_manual field will be handled by the original migration
    }
};
