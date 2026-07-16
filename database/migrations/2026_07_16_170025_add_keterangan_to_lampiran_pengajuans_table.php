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
        Schema::table('lampiran_pengajuans', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lampiran_pengajuans', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
};
