<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jenis_surats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kategori_surat_id')->constrained()->cascadeOnDelete();

            $table->string('kode_surat')->unique();

            $table->string('nama_surat');

            $table->text('deskripsi')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_surat');
    }
};
