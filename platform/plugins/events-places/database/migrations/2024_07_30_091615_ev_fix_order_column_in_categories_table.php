<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->integer('order')->unsigned()->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('ev_categories', function (Blueprint $table): void {
            $table->tinyInteger('order')->default(0)->change();
        });
    }
};
