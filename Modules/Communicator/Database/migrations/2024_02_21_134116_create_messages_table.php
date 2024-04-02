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
            $table->foreignIdFor(Template::class)->constrained('templates');
            $table->foreignIdFor(User::class)->constrained('users');
            $table->string('app')->unique();
            $table->json('message_data');
            $table->enum('status', ['sent', 'draft', 'failed', 'successful'])->default('draft');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->constrained('users')->after('created_at');
            $table->foreignId('updated_by')->nullable()->constrained('users')->after('updated_at');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->after('deleted_at');
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