<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('servername');
            $table->string('serverip');
            $table->string('description')->nullable()->default('Servidor');
            $table->string('status')->default('Desconocido');
            $table->string('statustime')->default('Desconocido');
            $table->string('lastcheck')->default('Desconocido');
            $table->string('lastresponse')->default('Desconocido');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
