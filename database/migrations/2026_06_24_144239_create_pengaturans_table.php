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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();

            $table->string('nama_desa');

            $table->text('alamat');

            $table->string('telepon')->nullable();

            $table->string('email')->nullable();

            $table->string('logo')->nullable();

            $table->string('nama_kepala_desa');

            $table->string('jabatan_kepala_desa');

            $table->string('gambar_ttd')->nullable();

            $table->string('stempel_desa')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
