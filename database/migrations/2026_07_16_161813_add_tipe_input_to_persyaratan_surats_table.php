<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('persyaratan_surats', function (Blueprint $table) {
            $table->enum('tipe_input', ['file', 'keterangan'])->default('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persyaratan_surats', function (Blueprint $table) {
            $table->dropColumn('tipe_input');
        });
    }
};
