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
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the existing foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade'); // Add a new foreign key constraint with cascade on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the modified foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade'); // Add a new foreign key constraint without cascade on delete
        });
    }
};

