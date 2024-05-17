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
        Schema::create('tbldeceaseinfo', function (Blueprint $table) {
            $table->id('deceaseID');
            $table->unsignedBigInteger('plotInventID')->nullable(); // Define the foreign key column
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('gender')->nullable();
            $table->string('reason')->nullable();
            $table->date('bornDate')->nullable();
            $table->date('diedDate')->nullable();
            $table->date('burialDate')->nullable();
            $table->foreign('plotInventID')->references('plotInventID')->on('tblplotinvent')->onDelete('cascade')->onUpdate('cascade'); // Add the foreign key constraint
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbldeceaseinfo');
    }
};
