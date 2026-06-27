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
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();

            $table->string('kode_pengajuan')->unique();

            $table->foreignId('penduduk_id')->constrained()->cascadeOnDelete();

            $table->foreignId('jenis_surat_id')->constrained()->cascadeOnDelete();

            $table->integer('nomor_antrian');

            $table->dateTime('tanggal_pengajuan');

            $table->text('keperluan');

            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');

            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
