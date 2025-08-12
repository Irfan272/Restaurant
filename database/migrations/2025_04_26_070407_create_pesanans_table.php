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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();

            $table->date('tanggal_pesanan');
            $table->time('waktu_pesanan');
            $table->string('status');
            $table->string('jenis_pesanan');
            $table->integer('total_pesanan');

            // Tambahan untuk masing-masing jenis pesanan
            $table->string('nomor_meja')->nullable();        // untuk dine in
            $table->string('nama_pelanggan')->nullable();    // untuk take away


            // Tambahan sesuai dengan controller
            $table->string('metode_pembayaran');
            $table->integer('uang_diterima')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
