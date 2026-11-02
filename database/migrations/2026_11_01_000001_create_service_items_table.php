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
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->default('fas fa-briefcase');
            $table->text('description');
            $table->json('features')->nullable(); // Bullet points
            $table->string('link_text')->default('Book Free Counseling');
            $table->string('link_url')->default('/contact');
            $table->string('badge')->nullable(); // e.g. "Free", "Popular"
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_items');
    }
};

