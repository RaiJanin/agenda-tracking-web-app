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
        // AGENDAS TABLE
        Schema::create('agendas', function (Blueprint $table) {
            $table->id('agenda_id');
            $table->string('title');
            $table->date('date');
            $table->uuid('created_by');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'ongoing', 'resolved', 'closed', 'completed'])->default('pending');
            $table->softDeletes(); // NEW: enable soft deletes
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
