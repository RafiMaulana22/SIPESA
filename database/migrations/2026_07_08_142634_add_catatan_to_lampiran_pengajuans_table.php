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
            $table
                ->enum('status', ['menunggu', 'valid', 'ditolak'])
                ->default('menunggu')
                ->after('file_path');

            $table->text('catatan')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lampiran_pengajuans', function (Blueprint $table) {
            $table->dropColumn(['status', 'catatan']);
        });
    }
};
