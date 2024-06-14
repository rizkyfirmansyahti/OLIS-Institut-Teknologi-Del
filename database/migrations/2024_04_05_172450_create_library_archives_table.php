<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('library_archives', function (Blueprint $table) {
            $table->id();
            $table->string('number')->index('library_archives_number_index');
            $table->string('title')->index('library_archives_title_index');
            $table->string('slug')->unique()->index('library_archives_slug_index');
            $table->string('file')->nullable();
            $table->boolean('active')->default(false)->comment('0: Inactive, 1: Active');
            $table->enum('type', ['rules', 'guidelines', 'achievements', 'others'])->default('rules');
            $table->longText('body');
            $table->string('excerpt');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_archives');
    }
};
