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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index('lendings_user_id_index');
            $table->unsignedBigInteger('book_id')->nullable()->index('lendings_book_id_index');
            $table->unsignedBigInteger('compact_disk_id')->nullable()->index('lendings_compact_disk_id_index');
            $table->unsignedBigInteger('created_by')->nullable()->index('lendings_created_by_index');
            $table->date('lending_date')->nullable();
            $table->date('return_date');
            $table->date('return_date_real')->nullable();
            $table->enum('status', ['pending', 'lent', 'returned', 'overdue', 'extend', 'rejected'])->default('pending'); // 'extend' and 'rejected' are added to the enum list
            $table->integer('fine')->default(0);
            $table->date('extend_date')->nullable();
            $table->timestamps();
        });

        Schema::table('lendings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
            $table->foreign('compact_disk_id')->references('id')->on('compact_disks')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
