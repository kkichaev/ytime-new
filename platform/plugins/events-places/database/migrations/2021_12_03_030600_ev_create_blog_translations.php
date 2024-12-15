<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('ev_posts_translations')) {
            Schema::create('ev_posts_translations', function (Blueprint $table): void {
                $table->string('lang_code', 20);
                $table->foreignId('ev_posts_id');
                $table->string('name')->nullable();
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'ev_posts_id'], 'posts_translations_primary');
            });
        }

        if (! Schema::hasTable('ev_categories_translations')) {
            Schema::create('ev_categories_translations', function (Blueprint $table): void {
                $table->string('lang_code', 20);
                $table->foreignId('ev_categories_id');
                $table->string('name')->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'ev_categories_id'], 'categories_translations_primary');
            });
        }

        if (! Schema::hasTable('ev_tags_translations')) {
            Schema::create('ev_tags_translations', function (Blueprint $table): void {
                $table->string('lang_code', 20);
                $table->foreignId('ev_tags_id');
                $table->string('name')->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'ev_tags_id'], 'tags_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ev_posts_translations');
        Schema::dropIfExists('ev_categories_translations');
        Schema::dropIfExists('ev_tags_translations');
    }
};
