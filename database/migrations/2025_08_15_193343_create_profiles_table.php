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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Basic Info
            $table->string('avatar')->nullable();
            $table->text('bio_ar')->nullable();
            $table->text('bio_en')->nullable();

            // Professional Info (for consultants, contractors, suppliers)
            $table->string('company_name')->nullable();
            $table->string('license_number')->nullable();
            $table->string('experience_years')->nullable();
            $table->text('specializations')->nullable(); // JSON array
            $table->text('services')->nullable(); // JSON array

            // Contact Info
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();

            // Location
            $table->string('emirate')->nullable(); // أبوظبي، دبي، الشارقة، إلخ
            $table->string('area')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Ratings & Reviews
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);

            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_premium')->default(false);
            $table->timestamp('premium_until')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
