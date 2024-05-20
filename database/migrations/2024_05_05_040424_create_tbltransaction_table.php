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
        Schema::create('tbltransaction', function (Blueprint $table) {
            $table->id('transactID');
            $table->unsignedBigInteger('deceaseID')->nullable(); 
            $table->string('transactRef')->nullable();
            $table->string('transactType')->nullable();
            $table->float('totalCost')->nullable();
            $table->date('transactDateTime')->nullable();
            $table->foreign('deceaseID')->references('deceaseID')->on('tbldeceaseinfo')->onDelete('cascade')->onUpdate('cascade'); // Add the foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbltransaction');
    }
};
