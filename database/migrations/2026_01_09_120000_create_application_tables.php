<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Churches ──
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('slug')->unique();
            $table->json('description')->nullable();
            $table->json('short_description')->nullable();
            $table->string('village')->nullable();
            $table->foreignId('banner_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('preview_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ── Church Services ──
        Schema::create('church_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();
            $table->json('service');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ── Church Contacts ──
        Schema::create('church_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // ── Church Images ──
        Schema::create('church_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ── News ──
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('excerpt')->nullable();
            $table->json('content');
            $table->string('author')->nullable();
            $table->foreignId('featured_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('banner_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('preview_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // ── News Images ──
        Schema::create('news_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ── Employees ──
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('position');
            $table->string('department')->nullable();
            $table->foreignId('photo_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->json('bio')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_chairman')->default(false);
            $table->timestamps();
        });

        // ── Banners ──
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('page_identifier');
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->string('type')->default('banner');
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ── Ministries ──
        Schema::create('ministries', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('short_description');
            $table->json('description')->nullable();
            $table->json('sub_departments')->nullable();
            $table->json('goals')->nullable();
            $table->foreignId('banner_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ── Ministry Images ──
        Schema::create('ministry_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ministry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ── Newsletters ──
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->integer('year');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->default('pdf');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletters');
        Schema::dropIfExists('ministry_images');
        Schema::dropIfExists('ministries');
        Schema::dropIfExists('news_images');
        Schema::dropIfExists('church_images');
        Schema::dropIfExists('church_contacts');
        Schema::dropIfExists('church_services');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('news');
        Schema::dropIfExists('churches');
    }
};
