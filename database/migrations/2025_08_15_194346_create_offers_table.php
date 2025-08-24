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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('professional_id')->constrained('users')->onDelete('cascade');
            $table->enum('professional_type', ['consultant', 'contractor', 'supplier']);

            // Offer Details
            $table->decimal('price', 15, 2);
            $table->text('description');
            $table->integer('duration_days')->nullable(); // Project duration in days
            $table->text('terms_conditions')->nullable();

            // Offer Status
            $table->enum('status', [
                'pending',      // Offer submitted, waiting for client review
                'accepted',     // Client accepted the offer
                'rejected',     // Client rejected the offer
                'withdrawn'     // Professional withdrew the offer
            ])->default('pending');

            // Client Response
            $table->text('client_notes')->nullable();
            $table->timestamp('responded_at')->nullable();

            // Files
            $table->text('attachments')->nullable(); // JSON array of file paths

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
