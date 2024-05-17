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
        Schema::create('tblmaintenance', function (Blueprint $table) {
            $table->id('maintainRec_ID');
            $table->unsignedBigInteger('staffID')->nullable(); // Define the foreign key column
            $table->unsignedBigInteger('deceaseID')->nullable(); // Define the foreign key column
            $table->string('maintenanceName')->nullable();
            $table->string('maintainDescription')->nullable();
            $table->float('amount')->nullable();
            $table->date('renewalPaymentDate')->nullable();
            $table->foreign('staffID')->references('staffID')->on('tblstaff')->onDelete('cascade')->onUpdate('cascade'); // Add the foreign key constraint
            $table->foreign('deceaseID')->references('deceaseID')->on('tbldeceaseinfo')->onDelete('cascade')->onUpdate('cascade'); // Add the foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblmaintenance');
    }
};
