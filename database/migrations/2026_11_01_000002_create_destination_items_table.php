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
        Schema::create('destination_items', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('flag')->default('🌍');
            $table->string('gradient')->default('linear-gradient(135deg, #0d2b8e, #1a73e8)');
            $table->string('badge')->nullable(); // e.g. "#1 Choice", "🔥 Most Popular"
            $table->string('short_detail')->nullable(); // e.g. "150+ Universities · 3-Year Degree"
            $table->text('description');
            $table->string('intakes')->nullable(); // e.g. "September, January, May"
            $table->string('post_study_work')->nullable(); // e.g. "2 Years (3 Years for PhD)"
            $table->string('extra_info')->nullable(); // e.g. "Scholarships: £1,500 – £8,000 / Merit Waivers"
            $table->string('link_text')->default('Explore Universities →');
            $table->string('link_url')->default('/contact');
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
        Schema::dropIfExists('destination_items');
    }
};

