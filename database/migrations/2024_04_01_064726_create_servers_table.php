<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_server');
            $table->decimal('latitude', 10, 8); // Kolom latitude, angka 10 menunjukkan jumlah digit total, dan angka 8 menunjukkan jumlah digit di belakang koma
            $table->decimal('longitude', 11, 8); // Kolom longitude, angka 11 menunjukkan jumlah digit total, dan angka 8 menunjukkan jumlah digit di belakang koma
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
