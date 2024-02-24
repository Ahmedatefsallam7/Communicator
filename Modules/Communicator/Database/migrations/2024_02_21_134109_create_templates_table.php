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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->enum('type', ['email', 'sms']);
            $table->json('path')->nullable();
            $table->json('body')->nullable();
            $table->json('subject')->nullable();
            $table->string('sender');
            $table->json('variable');
            $table->string('attachment')->nullable();
            $table->json('cc')->nullable();
            $table->json('bcc')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};