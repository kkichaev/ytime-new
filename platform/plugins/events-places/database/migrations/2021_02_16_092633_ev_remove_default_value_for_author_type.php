<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('ev_categories', 'author_type')) {
            Schema::table('ev_categories', function (Blueprint $table): void {
                $table->string('author_type');
            });
        }

        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->string('author_type')->change();
        });

        if (! Schema::hasColumn('ev_tags', 'author_type')) {
            Schema::table('ev_tags', function (Blueprint $table): void {
                $table->string('author_type');
            });
        }

        Schema::table('ev_tags', function (Blueprint $table): void {
            $table->string('author_type')->change();
        });

        if (! Schema::hasColumn('ev_posts', 'author_type')) {
            Schema::table('ev_posts', function (Blueprint $table): void {
                $table->string('author_type');
            });
        }

        Schema::table('ev_posts', function (Blueprint $table): void {
            $table->string('author_type')->change();
        });
    }

    public function down(): void
    {
        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->string('author_type')->default(addslashes(User::class))->change();
        });

        Schema::table('ev_tags', function (Blueprint $table): void {
            $table->string('author_type')->default(addslashes(User::class))->change();
        });

        Schema::table('ev_posts', function (Blueprint $table): void {
            $table->string('author_type')->default(addslashes(User::class))->change();
        });
    }
};
