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
            $table->json('name')->unique();
            $table->enum('type', ['email', 'sms']);
            $table->json('subject');
            $table->json('body_text')->nullable();
            $table->string('attachment')->nullable();
            $table->string('path')->nullable();
            $table->json('variables')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Add UserStamps
        Schema::table('templates', function (Blueprint $table) {
            $table->bigInteger('created_by')->unsigned()->nullable()->index()->after('created_at');
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable()->index()->after('updated_at');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index()->after('deleted_at');
            $table->foreign('deleted_by')->references('id')->on('users');
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
