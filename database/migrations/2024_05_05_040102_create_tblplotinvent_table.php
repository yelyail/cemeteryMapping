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
        Schema::create('tblplotinvent', function (Blueprint $table) {
            $table->id('plotInventID');
            $table->unsignedBigInteger('ownerID')->nullable();
            $table->string('cemName')->nullable();
            $table->integer('plotNum')->nullable();
            $table->integer('plotTotal')->nullable();
            $table->float('plotPrice')->nullable();
            $table->string('stat')->nullable();
            $table->integer('post_status')->nullable();
            $table->float('plotMaintenanceFee')->nullable();
            $table->string('size')->nullable();
            $table->date('establishmentDate')->nullable();
            $table->date('purchaseDate')->nullable();
            $table->foreign('ownerID')->references('ownerID')->on('tblowner')->onDelete('cascade')->onUpdate('cascade'); // Add the foreign key constraint
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblplotinvent');
    }
};
