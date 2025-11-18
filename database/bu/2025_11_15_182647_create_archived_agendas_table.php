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
        Schema::create('archived_agendas', function (Blueprint $table) {
            $table->id('archived_agenda_id'); // PK for this table
   $table->foreignId('agenda_id')
          ->constrained('agendas', 'agenda_id')
          ->onDelete('cascade');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_agendas');
    }
};
