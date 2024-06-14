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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique()->index('books_code_index');
            $table->string('title')->nullable()->index('books_title_index');
            $table->string('slug')->nullable()->index('books_slug_index');
            $table->string('author')->nullable()->index('books_author_index');
            $table->string('isbn')->nullable()->index('books_isbn_index');
            $table->string('cover')->nullable();
            $table->string('description')->nullable();
            $table->string('publisher')->nullable();
            $table->string('language')->nullable();
            $table->string('edition')->nullable();
            $table->string('subject')->nullable()->index('books_subject_index');
            $table->string('classification')->nullable();
            $table->string('cp_or')->nullable();
            $table->integer('year')->nullable();
            $table->string('location')->nullable()->index('books_location_index');
            $table->integer('status')->default(1)->comment('1 = Available, 2 = Borrowed, 3 = Lost');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
