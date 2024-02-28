<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Communicator\App\Models\Template;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Template::class)->constrained('templates')->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->string('app')->unique();
            $table->json('message_data');
            $table->enum('status', ['sent', 'draft', 'failed', 'successful'])->default('draft');
            $table->softDeletes();
            $table->timestamps();
        });

        // Add UserStamps
        Schema::table('messages', function (Blueprint $table) {
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
        Schema::dropIfExists('messages');
    }
};
