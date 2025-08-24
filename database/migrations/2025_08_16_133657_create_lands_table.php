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
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('land_type', ['residential', 'commercial', 'agricultural', 'industrial']);
            $table->decimal('area', 10, 2);
            $table->decimal('price', 15, 2);
            $table->enum('city', ['riyadh', 'jeddah', 'dammam', 'makkah', 'medina', 'taif', 'abha', 'jubail', 'yanbu', 'other']);
            $table->string('district');
            $table->text('address')->nullable();
            $table->enum('transaction_type', ['sale', 'exchange', 'both']);
            $table->text('description');
            $table->json('features')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_whatsapp')->nullable();
            $table->string('contact_email')->nullable();
            $table->json('desired_locations')->nullable();
            $table->enum('status', ['active', 'pending', 'completed', 'cancelled'])->default('active');
            $table->integer('views')->default(0);
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};
