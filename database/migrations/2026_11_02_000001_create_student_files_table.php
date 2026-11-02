<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('destination')->nullable();
            $table->string('desired_course')->nullable();
            $table->string('intake')->nullable();
            $table->string('education_level')->nullable();
            $table->string('english_test')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'contacted', 'in_progress', 'admitted', 'visa_granted', 'rejected', 'closed'])->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });

        // Copy existing data from inquiries table if it exists
        if (Schema::hasTable('inquiries')) {
            $existing = DB::table('inquiries')->get();
            foreach ($existing as $row) {
                DB::table('student_files')->insert([
                    'id'             => $row->id,
                    'name'           => $row->name,
                    'email'          => $row->email,
                    'phone'          => $row->phone,
                    'destination'    => $row->destination,
                    'message'        => $row->message,
                    'status'         => $row->status ?? 'new',
                    'assigned_to'    => $row->assigned_to,
                    'internal_notes' => $row->internal_notes,
                    'created_at'     => $row->created_at,
                    'updated_at'     => $row->updated_at,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_files');
    }
};

