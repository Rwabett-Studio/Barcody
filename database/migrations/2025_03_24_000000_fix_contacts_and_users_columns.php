<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete()->after('phone');
            $table->boolean('invited')->default(false)->after('event_id');
            $table->string('status')->default('pending')->after('invited');
            $table->timestamp('invited_at')->nullable()->after('status');
            $table->timestamp('responded_at')->nullable()->after('invited_at');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('create_role')->default(1)->after('role');
            $table->boolean('edit_role')->default(1)->after('create_role');
            $table->boolean('delete_role')->default(1)->after('edit_role');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn(['event_id', 'invited', 'status', 'invited_at', 'responded_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['create_role', 'edit_role', 'delete_role']);
        });
    }
};
