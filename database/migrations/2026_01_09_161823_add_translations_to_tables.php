<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Churches - make name and description translatable
        Schema::table('churches', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });

        // News - make title, excerpt, content translatable
        Schema::table('news', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('excerpt')->nullable()->change();
            $table->json('content')->change();
        });

        // Employees - make name, position, bio translatable
        Schema::table('employees', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('position')->change();
            $table->json('bio')->nullable()->change();
        });

        // Banners - make title and subtitle translatable
        Schema::table('banners', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('subtitle')->nullable()->change();
        });

        // Church Services - make service translatable
        Schema::table('church_services', function (Blueprint $table) {
            $table->json('service')->change();
        });
    }

    public function down(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('excerpt')->nullable()->change();
            $table->longText('content')->change();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('position')->change();
            $table->text('bio')->nullable()->change();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->text('subtitle')->nullable()->change();
        });

        Schema::table('church_services', function (Blueprint $table) {
            $table->string('service')->change();
        });
    }
};