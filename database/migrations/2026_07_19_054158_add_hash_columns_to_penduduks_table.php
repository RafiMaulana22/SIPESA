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
        Schema::table('penduduks', function (Blueprint $table) {
            // Hash untuk pencarian NIK
            $table->string('nik_hash', 64)->nullable()->unique()->after('nik');

            // Hash untuk pencarian No KK
            $table->string('no_kk_hash', 64)->nullable()->after('no_kk');

            $table->index('no_kk_hash');

            // Hash untuk pencarian No HP
            $table->string('no_hp_hash', 64)->nullable()->after('no_hp');

            $table->index('no_hp_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn(['nik_hash', 'no_kk_hash', 'no_hp_hash']);
        });
    }
};
