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
        Schema::create('logperbaikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('server_id')->nullable();
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('set null');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('set null');
            $table->date('tanggal');
            $table->enum('judul', ['Nilai1', 'Nilai2', 'Nilai3', '']);
            $table->text('keterangan');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logperbaikan');
    }
};
