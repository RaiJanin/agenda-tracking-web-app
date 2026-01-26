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
        if(!Schema::hasTable('comments'))
        {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
                $table->morphs('commentable'); // supports polymorphic relation: agendas, concerns, etc.
                $table->text('content');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
