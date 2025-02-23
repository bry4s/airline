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
        Schema::create('archived_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plane_id');
            $table->string('from');
            $table->string('to');
            $table->float('price');
            $table->integer('count');
            $table->integer('seats');
            $table->timestamp('departure');
            $table->timestamp('arrival')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
