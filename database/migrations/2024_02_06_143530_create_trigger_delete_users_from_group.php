<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create trigger
    //     DB::unprepared('
    //      CREATE TRIGGER tr_delete_users_from_group AFTER UPDATE ON chats
    //      FOR EACH ROW
    //      BEGIN
    //          IF NEW.deleted <> OLD.deleted THEN
    //              UPDATE user_chat SET deleted = NEW.deleted WHERE chat_id = OLD.id;
    //          END IF;
    //      END;
    //  ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    // DB::unprepared('DROP TRIGGER IF EXISTS tr_delete_users_from_group');
    }
};
