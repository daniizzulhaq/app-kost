<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('restrict');
            $table->string('nama');
            $table->string('tempat_kerja')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat_asal')->nullable();
            $table->enum('jenis_sewa', ['Harian', 'Bulanan'])->default('Bulanan');
            $table->decimal('harga_sewa', 12, 2);
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status', ['AKTIF', 'TIDAK_AKTIF'])->default('AKTIF');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};