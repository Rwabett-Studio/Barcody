<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp')->nullable()->after('phone');
            $table->timestamp('otp_expires_at')->nullable()->after('otp');
            $table->timestamp('phone_verified_at')->nullable()->after('otp_expires_at');
            $table->string('image')->nullable()->after('phone_verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['otp', 'otp_expires_at', 'phone_verified_at', 'image']);
        });
    }
};
