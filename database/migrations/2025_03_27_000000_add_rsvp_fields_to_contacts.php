<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'invitation_token')) {
                $table->string('invitation_token', 64)->nullable()->unique()->after('event_id');
            }
            if (!Schema::hasColumn('contacts', 'guests_count')) {
                $table->unsignedInteger('guests_count')->nullable()->after('status');
            }
            if (!Schema::hasColumn('contacts', 'qr_path')) {
                $table->string('qr_path')->nullable()->after('guests_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['invitation_token', 'guests_count', 'qr_path']);
        });
    }
};
