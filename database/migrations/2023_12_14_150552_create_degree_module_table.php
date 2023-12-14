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
        Schema::create('degree_module', function (Blueprint $table) {
            $table->unsignedBigInteger('degree_id')->unsigned();
            $table->unsignedBigInteger('module_id')->unsigned();

            $table->primary(['degree_id', 'module_id']);
            $table->foreign('degree_id')->references('id')->on('degrees')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('module_id')->references('id')->on('modules')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_module');
    }
};
