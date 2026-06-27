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
        Schema::create('lampiran_pengajuans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_surat_id')->constrained()->cascadeOnDelete();

            $table->foreignId('persyaratan_surat_id')->constrained()->cascadeOnDelete();

            $table->string('nama_file');

            $table->string('file_path');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran_pengajuans');
    }
};
