<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gedung_id')->constrained('gedungs')->onDelete('cascade');
            $table->string('nomor_kamar');
            $table->enum('tipe_kamar', ['VIP', 'Regular'])->default('Regular');
            $table->decimal('harga_harian', 12, 2)->default(0);
            $table->decimal('harga_bulanan', 12, 2)->default(0);
            $table->enum('status', ['KOSONG', 'TERISI', 'RENOVASI'])->default('KOSONG');
            $table->timestamps();

            $table->unique(['gedung_id', 'nomor_kamar']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};