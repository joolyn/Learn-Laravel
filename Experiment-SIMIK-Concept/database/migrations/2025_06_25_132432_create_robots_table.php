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
        Schema::create('robots', function (Blueprint $table) {
            $table->id('id_robot');
            $table->string('robot_code')->unique();
            $table->string('photo', length: 100);
            $table->string('name', length: 50);
            $table->string('description', length: 250);
            $table->integer('status')->default('1'); // 1 artinya aktif, 0 tidak aktif
            $table->string('secret_key', length: 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robots');
    }
};
