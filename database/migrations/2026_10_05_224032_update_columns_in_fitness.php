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
        Schema::table('fitness', function (Blueprint $table) {
            $table->dropColumn('height');

            $table->integer('height_ft')->nullable(); 
            $table->integer('height_in')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fitness', function (Blueprint $table) {
            $table->string('height'); 
            $table->dropColumn('height_ft');
            $table->dropColumn('height_in');
        });
    }
};
