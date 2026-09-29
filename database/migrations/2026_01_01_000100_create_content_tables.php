<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_keahlians', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->text('summary')->nullable();
            $table->json('sections')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sarana_prasaranas', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('ekstrakurikulers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('organisasi_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('teaching_factories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('partner_name')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('program_keahlian_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('alt')->nullable();
            $table->string('group')->default('default');
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['group', 'sort_order']);
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name')->nullable();
            $table->string('class_name')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('level')->nullable();
            $table->date('achieved_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->string('source')->nullable();
            $table->string('external_url')->nullable();
            $table->dateTime('published_at');
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'published_at']);
        });

        Schema::create('site_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('ppdb_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->default('clipboard');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('ppdb_programs', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('program_keahlian_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('general');
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();

            $table->index('group');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('ppdb_programs');
        Schema::dropIfExists('ppdb_steps');
        Schema::dropIfExists('site_statistics');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('teaching_factories');
        Schema::dropIfExists('organisasi_siswas');
        Schema::dropIfExists('ekstrakurikulers');
        Schema::dropIfExists('sarana_prasaranas');
        Schema::dropIfExists('program_keahlians');
    }
};
