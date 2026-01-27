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
        if(!Schema::hasTable('membership_request'))
        {
            Schema::create('membership_request', function (Blueprint $table) {
                $table->id();
                $table->foreignUuid('user_id')->constrained('users');
                $table->string('name');
                $table->string('member_role');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_request');
    }
};
