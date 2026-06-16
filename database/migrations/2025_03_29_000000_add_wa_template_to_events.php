<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'wa_template_name')) {
                $table->string('wa_template_name')->nullable()->after('status');
            }
            if (!Schema::hasColumn('events', 'wa_template_language')) {
                $table->string('wa_template_language', 10)->nullable()->default('ar')->after('wa_template_name');
            }
            if (!Schema::hasColumn('events', 'wa_template_params')) {
                $table->text('wa_template_params')->nullable()->after('wa_template_language');
            }
            if (!Schema::hasColumn('events', 'wa_template_header_image')) {
                $table->string('wa_template_header_image')->nullable()->after('wa_template_params');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['wa_template_name', 'wa_template_language', 'wa_template_params', 'wa_template_header_image']);
        });
    }
};
