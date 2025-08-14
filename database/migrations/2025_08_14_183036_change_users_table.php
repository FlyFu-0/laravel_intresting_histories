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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->timestamp('banned_at')->nullable();
            $table->timestamp('unbanned_at')->nullable();
            $table->timestamp('muted_at')->nullable();
            $table->timestamp('muted_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('banned_at');
            $table->dropColumn('unbanned_at');
            $table->dropColumn('muted_at');
            $table->dropColumn('muted_until');
        });
    }
};
