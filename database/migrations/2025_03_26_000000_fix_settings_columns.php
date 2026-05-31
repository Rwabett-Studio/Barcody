<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('settings', 'maps')) {
                $table->string('maps')->nullable()->after('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['name', 'maps']);
        });
    }
};
