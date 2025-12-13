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
        if(!Schema::hasTable('tags'))
        {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }
        
        if(!Schema::hasTable('taggables'))
        {
            Schema::create('taggables', function (Blueprint $table) {
                $table->foreignId('tag_id')->constrained();
                $table->morphs('taggable'); // agenda, concern
                $table->primary(['tag_id', 'taggable_id', 'taggable_type']);
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
