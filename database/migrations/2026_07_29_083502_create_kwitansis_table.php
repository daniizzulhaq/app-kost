<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kwitansis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kwitansi')->unique();
            $table->foreignId('pembayaran_id')->constrained('pembayarans')->onDelete('cascade');
            $table->boolean('sudah_dicetak')->default(false);
            $table->timestamp('tanggal_cetak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kwitansis');
    }
};