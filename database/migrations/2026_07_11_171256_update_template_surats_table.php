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
        Schema::table('template_surats', function (Blueprint $table) {
            // hapus kolom isi template
            $table->dropColumn('isi_template');

            // ganti menjadi file template
            $table->string('file_template')->after('judul_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_surats', function (Blueprint $table) {
            $table->dropColumn('file_template');

            $table->longText('isi_template')->after('judul_surat');
        });
    }
};
