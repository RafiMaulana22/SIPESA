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
        Schema::create('arsip_surats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_surat_id')->constrained()->cascadeOnDelete();

            $table->string('nomor_surat')->unique();

            $table->date('tanggal_surat');

            $table->string('file_pdf');

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surats');
    }
};
