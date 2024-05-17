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
        Schema::create('tblstaff', function (Blueprint $table) {
            $table->id('staffID');
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->string('contactNum')->nullable();
            $table->string('contactEmail')->unique();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblstaff');
    }
};
