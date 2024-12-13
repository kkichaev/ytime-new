<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->foreignId('author_id')->nullable()->change();
        });

        Schema::table('ev_tags', function (Blueprint $table): void {
            $table->foreignId('author_id')->nullable()->change();
        });

        Schema::table('ev_posts', function (Blueprint $table): void {
            $table->foreignId('author_id')->nullable()->change();
        });
    }
};
