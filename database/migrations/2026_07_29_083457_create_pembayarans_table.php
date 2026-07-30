<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pembayaran')->unique();
            $table->foreignId('penyewa_id')->constrained('penyewas')->onDelete('restrict');
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('restrict');
            $table->enum('jenis_pembayaran', ['Harian', 'Bulanan'])->default('Bulanan');
            $table->string('periode'); // contoh: "Agustus 2026"
            $table->date('tanggal_bayar');
            $table->decimal('jumlah_tagihan', 12, 2);
            $table->decimal('jumlah_dibayar', 12, 2);
            $table->decimal('sisa_tagihan', 12, 2)->default(0);
            $table->enum('status', ['LUNAS', 'SEBAGIAN'])->default('LUNAS');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};