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
        Schema::create('land_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_id')->constrained()->onDelete('cascade');
            $table->foreignId('offerer_id')->constrained('users')->onDelete('cascade');
            $table->enum('offer_type', ['purchase', 'exchange']);
            $table->decimal('offer_price', 15, 2)->nullable();
            $table->text('offer_message');
            $table->string('offerer_name');
            $table->string('offerer_phone');
            $table->string('offerer_email')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_offers');
    }
};
