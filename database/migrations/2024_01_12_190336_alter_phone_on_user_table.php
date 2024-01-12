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
        Schema::table('users', function (Blueprint $table) {
            // Renombrar el campo phoneNumber1 a phone_number1
            $table->renameColumn('phoneNumber1', 'phone_number1');
            $table->renameColumn('phoneNumber2', 'phone_number2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // En la reversión, puedes volver a renombrar de phone_number1 a phoneNumber1 si es necesario
            $table->renameColumn('phone_number1', 'phoneNumber1');
            $table->renameColumn('phone_number2', 'phoneNumber2');
        });
    }
};
