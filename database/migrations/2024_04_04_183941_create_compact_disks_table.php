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
        Schema::create('compact_disks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique()->index('compact_disks_code_index');
            $table->string('title')->nullable()->index('compact_disks_title_index');
            $table->string('subject')->nullable()->index('compact_disks_subject_index');
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('source')->nullable();
            $table->string('cover')->nullable();
            $table->string('major')->nullable();
            $table->string('category')->nullable();
            $table->integer('year')->nullable();
            $table->string('cd_dvd')->nullable();
            $table->integer('status')->default('1')->comment('1 = Available, 2 = Borrowed, 3 = Lost');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compact_disks');
    }
};
