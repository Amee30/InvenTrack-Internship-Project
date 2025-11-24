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
        Schema::table('borrowings', function (Blueprint $table) {
            // Ubah dari date ke datetime
            $table->dateTime('borrowed_at')->change();
            $table->dateTime('return_due_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            // Rollback ke date
            $table->date('borrowed_at')->change();
            $table->date('return_due_date')->change();
        });
    }
};
