<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ev_posts', function (Blueprint $table): void {
            $table->index('status', 'ev_posts_status_index');
            $table->index('author_id', 'ev_posts_author_id_index');
            $table->index('author_type', 'ev_posts_author_type_index');
            $table->index('created_at', 'ev_posts_created_at_index');
        });

        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->index('parent_id', 'ev_categories_parent_id_index');
            $table->index('status', 'ev_categories_status_index');
            $table->index('created_at', 'ev_categories_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('ev_posts', function (Blueprint $table): void {
            $table->dropIndex('ev_posts_status_index');
            $table->dropIndex('ev_posts_author_id_index');
            $table->dropIndex('ev_posts_author_type_index');
            $table->dropIndex('ev_posts_created_at_index');
        });

        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->dropIndex('ev_categories_parent_id_index');
            $table->dropIndex('ev_categories_status_index');
            $table->dropIndex('ev_categories_created_at_index');
        });
    }
};
