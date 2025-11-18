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
        Schema::create('archived_concerns', function (Blueprint $table) {
            $table->id('archived_concerns_id'); // PK for this table
           $table->foreignId('concern_id')
          ->constrained('concerns', 'concern_id') 
          ->onDelete('cascade');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_concerns');
    }
};
