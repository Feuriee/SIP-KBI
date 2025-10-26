<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('kolams', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->text('lokasi')->nullable();
        $table->integer('kapasitas')->default(0); // misal liter atau ekor
        $table->integer('jumlah_ikan')->default(0);
        $table->enum('status', ['aktif','rusak','kosong'])->default('aktif');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolams');
    }
};
