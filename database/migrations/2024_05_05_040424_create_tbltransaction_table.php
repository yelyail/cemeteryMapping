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
            $table->unsignedBigInteger('maintainRec_ID')->nullable(); 
            $table->string('transactRef')->nullable();
            $table->string('transactType')->nullable();
            $table->float('totalCost')->nullable();
            $table->date('transactDateTime')->nullable();
            $table->foreign('maintainRec_ID')->references('maintainRec_ID')->on('tblmaintenance')->onDelete('cascade')->onUpdate('cascade'); // Add the foreign key constraint
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
