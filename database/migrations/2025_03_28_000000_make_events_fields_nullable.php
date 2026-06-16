<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('events')) {
            return;
        }
        // Raw statements avoid the doctrine/dbal requirement for ->change()
        DB::statement("ALTER TABLE `events` MODIFY `thumbnail_image` VARCHAR(255) NULL DEFAULT NULL");
        DB::statement("ALTER TABLE `events` MODIFY `description` TEXT NULL");
        DB::statement("ALTER TABLE `events` MODIFY `maps` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `events` MODIFY `time` VARCHAR(255) NULL");
    }

    public function down(): void
    {
        // no-op (keeping columns nullable is safe)
    }
};
