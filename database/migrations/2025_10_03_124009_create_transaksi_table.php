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
        Schema::create('transaksi', function (Blueprint $table) {
            // Kolom primary key auto increment
            $table->bigIncrements('transaksi_id');

            // Kolom foreign key / relasi
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id'); // hati-hati, "id" sudah umum dipakai di banyak tabel

            // Kolom tambahan
            $table->string('order_id');
            $table->decimal('price', 15, 2); // lebih aman pakai decimal untuk uang
            $table->string('status');
            $table->string('snap_token')->nullable(); // bisa nullable

            // created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
