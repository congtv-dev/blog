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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('description', 500);
            $table->string('thumbnail')->nullable();
            $table->text('content');
            $table->enum('on_home', ['Yes', 'No'])->default('Yes');
            $table->enum('published', ['Yes', 'No'])->default('Yes');
            $table->enum('approved', ['Yes', 'No'])->default('Yes');
            $table->enum('featured', ['Yes', 'No'])->default('No');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
