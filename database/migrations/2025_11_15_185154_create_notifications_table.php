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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade'); // FK to users

            $table->string('type'); // e.g., 'assigned', 'status_change', 'overdue'
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->foreignId('related_id')->nullable(); // FK to agenda or concern
            $table->string('related_type')->nullable(); // Polymorphic: agenda, concern
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
