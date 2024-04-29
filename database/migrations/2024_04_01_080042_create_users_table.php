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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama harus unik
            $table->string('email')->unique(); // Email harus unik
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('kontak')->nullable(); // Kolom kontak
            $table->string('alamat')->nullable(); // Kolom alamat
            $table->year('tahun_langganan')->nullable(); // Kolom tahun_langganan
            $table->unsignedBigInteger('server_id')->nullable(); // Kolom server_id
            $table->enum('role', ['admin', 'teknisi', 'klien'])->default('klien');
            $table->enum('status', ['active', 'inactive'])->default('active'); // Kolom status
            $table->double('latitude', 10, 8)->nullable(); // Kolom latitude
            $table->double('longitude', 11, 8)->nullable(); // Kolom longitude
            $table->string('image')->nullable(); // Kolom image
            $table->rememberToken();
            $table->timestamps();

            // Menambahkan kunci asing ke tabel server
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
