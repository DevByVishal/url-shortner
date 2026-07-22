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
        Schema::create('url_visits', function (Blueprint $table) {

            $table->id();

            $table->foreignId('short_url_id');

            $table->ipAddress('ip_address')->nullable();

            $table->text('user_agent')->nullable();

            $table->text('referer')->nullable();

            $table->timestamp('visited_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_visits');
    }
};
