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
          // CONCERNS TABLE
    
        Schema::create('concerns', function (Blueprint $table) {
            $table->id('concern_id');

            $table->foreignId('agenda_id')
                ->constrained('agendas', 'agenda_id')
                ->onDelete('cascade');

            $table->uuid('responsible_person_id');
            $table->foreign('responsible_person_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->text('description');
            $table->enum('status', ['pending', 'ongoing', 'resolved', 'closed', 'completed'])->default('pending');
            $table->date('due_date')->nullable();
            $table->softDeletes(); // NEW: enable soft deletes
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerns');
    }
};
