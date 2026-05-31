<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('item1')->nullable();
            $table->string('item2')->nullable();
            $table->string('item3')->nullable();
            $table->string('item4')->nullable();
            $table->string('item5')->nullable();
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer');
            $table->timestamps();
        });

        Schema::create('herosections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->timestamps();
        });

        Schema::create('how_use_barcodys', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('informations', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('icon1')->nullable();
            $table->string('title1')->nullable();
            $table->string('icon2')->nullable();
            $table->string('title2')->nullable();
            $table->string('icon3')->nullable();
            $table->string('title3')->nullable();
            $table->string('icon4')->nullable();
            $table->string('title4')->nullable();
            $table->string('image_app1')->nullable();
            $table->string('image_app2')->nullable();
            $table->string('main_image')->nullable();
            $table->timestamps();
        });

        Schema::create('invitation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default('invitation');
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('invitation_categories');
        Schema::dropIfExists('informations');
        Schema::dropIfExists('how_use_barcodys');
        Schema::dropIfExists('herosections');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('plans');
    }
};
