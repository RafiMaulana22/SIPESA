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
        Schema::table('lampiran_pengajuans', function (Blueprint $table) {
            $table->string('nama_file')->nullable()->change();
            $table->string('file_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lampiran_pengajuans', function (Blueprint $table) {
            $table->string('nama_file')->nullable(false)->change();
            $table->string('file_path')->nullable(false)->change();
        });
    }
};
