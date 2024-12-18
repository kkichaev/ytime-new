<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('ev_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->foreignId('parent_id')->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->foreignId('author_id');
            $table->string('author_type')->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('ev_tags', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->foreignId('author_id');
            $table->string('author_type')->default(addslashes(User::class));
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ev_posts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published');
            $table->foreignId('author_id');
            $table->string('author_type')->default(addslashes(User::class));
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('image')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->string('format_type', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('ev_post_tags', function (Blueprint $table): void {
            $table->foreignId('ev_tag_id')->index();
            $table->foreignId('ev_post_id')->index();
        });

        Schema::create('ev_post_categories', function (Blueprint $table): void {
            $table->foreignId('ev_category_id')->index();
            $table->foreignId('ev_post_id')->index();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ev_post_tags');
        Schema::dropIfExists('ev_post_categories');
        Schema::dropIfExists('ev_posts');
        Schema::dropIfExists('ev_categories');
        Schema::dropIfExists('ev_tags');
    }
};
