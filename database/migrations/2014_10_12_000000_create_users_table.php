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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_member', 10)->unique()->nullable()->index('users_id_member_index');
            $table->string('name')->index('users_name_index');
            $table->string('email')->unique()->nullable()->index('users_email_index');
            $table->string('password');
            $table->char('phone', 13)->nullable();
            $table->string('address')->nullable();
            $table->string('major')->nullable();
            $table->string('position')->nullable();
            $table->integer('lending_limit')->default(7);
            $table->double('fine', 10, 2)->default(0);
            $table->string('lending_count')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
