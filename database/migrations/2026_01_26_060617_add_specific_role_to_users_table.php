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
        if(!Schema::hasColumn('users', 'specific_role'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->string('specific_role')->after('role')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('users', 'specific_role'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('specific_role');
            });
        }
    }
};
