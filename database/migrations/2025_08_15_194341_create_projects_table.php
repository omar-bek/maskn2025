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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');

            // Project Details
            $table->string('property_type'); // residential, commercial, villa
            $table->string('style'); // modern, classic, traditional
            $table->decimal('area', 10, 2); // Area in square meters
            $table->string('location'); // City/Emirate
            $table->string('neighborhood')->nullable();

            // Building Details (from cost calculator)
            $table->integer('floors')->default(1); // Number of floors
            $table->integer('majlis_count')->default(1); // Number of majlis
            $table->integer('bedrooms')->default(1); // Number of bedrooms
            $table->integer('guest_bedrooms')->default(0); // Number of guest bedrooms
            $table->integer('bathrooms')->default(1); // Number of bathrooms
            $table->integer('parking_spaces')->default(1); // Number of parking spaces
            $table->integer('other_rooms')->default(0); // Other rooms

            // Finishing Level (from cost calculator)
            $table->enum('finishing_level', ['low', 'medium', 'high'])->default('medium');

            // Additional Features (from cost calculator)
            $table->json('additional_features')->nullable(); // garden, pool, elevator, basement

            // Additional Notes (from cost calculator)
            $table->text('additional_notes')->nullable();

            // Cost Estimation
            $table->decimal('estimated_cost', 15, 2);
            $table->decimal('budget_min', 15, 2)->nullable();
            $table->decimal('budget_max', 15, 2)->nullable();

            // Project Status
            $table->enum('status', [
                'draft',           // Client created but not published
                'published',       // Published for consultants
                'consultant_selected', // Client selected consultant
                'design_ready',    // Consultant uploaded design
                'contractor_bidding', // Open for contractor bids
                'contractor_selected', // Client selected contractor
                'supplier_bidding', // Open for supplier bids
                'supplier_selected', // Client selected supplier
                'in_progress',     // Project started
                'completed',       // Project completed
                'cancelled'        // Project cancelled
            ])->default('draft');

            // Selected Professionals
            $table->foreignId('selected_consultant_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('selected_contractor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('selected_supplier_id')->nullable()->constrained('users')->onDelete('set null');

            // Timestamps
            $table->timestamp('published_at')->nullable();
            $table->timestamp('consultant_selected_at')->nullable();
            $table->timestamp('design_ready_at')->nullable();
            $table->timestamp('contractor_selected_at')->nullable();
            $table->timestamp('supplier_selected_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
