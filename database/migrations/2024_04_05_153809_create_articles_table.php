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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index('articles_title_index');
            $table->string('slug')->unique()->index('articles_slug_index');
            $table->longText('body');
            $table->string('excerpt');
            $table->string('image');
            $table->unsignedBigInteger('user_id')->nullable()->index('articles_user_id_index');
            $table->integer('status')->default(1)->comment('1 = Publish, 2 = Draft, 3 = Archive');
            $table->integer('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
