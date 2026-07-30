<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('secure_shares', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('token', 80)->unique();
            $table->string('access_code_hash');
            $table->text('secure_url')->nullable();
            $table->longText('secret_payload')->nullable();
            $table->timestamp('expires_at');
            $table->timestamp('last_accessed_at')->nullable();
            $table->unsignedInteger('access_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secure_shares');
    }
};
