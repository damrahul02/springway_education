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
        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->string('step_number')->nullable(); // e.g. "01", "02"
            $table->string('title');                  // e.g. "Free Consultation & Exploration"
            $table->text('description');             // Detailed roadmap explanation
            $table->text('short_description')->nullable(); // Brief 1-2 sentence for homepage
            $table->string('badge')->nullable();      // e.g. "Duration: 45–60 mins · Cost: 100% Free"
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
        Schema::dropIfExists('process_steps');
    }
};

