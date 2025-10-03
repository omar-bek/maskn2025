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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->foreignId('consultant_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('style'); // عصري، إسلامي، حديث، إلخ

            // Specifications
            $table->decimal('area', 10, 2); // المساحة بالمتر المربع
            $table->string('location')->nullable();
            $table->decimal('price', 15, 2); // السعر المقدر
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('floors')->default(1);
            $table->json('features')->nullable(); // المميزات الإضافية

            // Contact Information
            $table->string('consultant_name');
            $table->string('consultant_phone')->nullable();
            $table->string('consultant_email')->nullable();

            // Images
            $table->string('main_image')->nullable(); // الصورة الرئيسية
            $table->json('images')->nullable(); // الصور الإضافية

            // Status
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->decimal('rating', 3, 2)->default(0); // تقييم التصميم
            $table->integer('views_count')->default(0); // عدد المشاهدات

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
