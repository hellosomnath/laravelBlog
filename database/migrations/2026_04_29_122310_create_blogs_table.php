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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('feature_image')->nullable();
            $table->foreignId('user_id')->contrained()->onDelete('cascade');
            $table->string('author', 100);
            $table->string('tags', 100)->nullable();
            $table->date('published_on');
            $table->boolean('is_published')->default(1)->comment("0 = Not published, 1 = Published");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
