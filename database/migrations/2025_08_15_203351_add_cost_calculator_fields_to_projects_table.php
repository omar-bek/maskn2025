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
        Schema::table('projects', function (Blueprint $table) {
            // Building Details (from cost calculator)
            $table->integer('floors')->default(1)->after('neighborhood'); // Number of floors
            $table->integer('majlis_count')->default(1)->after('floors'); // Number of majlis
            $table->integer('bedrooms')->default(1)->after('majlis_count'); // Number of bedrooms
            $table->integer('guest_bedrooms')->default(0)->after('bedrooms'); // Number of guest bedrooms
            $table->integer('bathrooms')->default(1)->after('guest_bedrooms'); // Number of bathrooms
            $table->integer('parking_spaces')->default(1)->after('bathrooms'); // Number of parking spaces
            $table->integer('other_rooms')->default(0)->after('parking_spaces'); // Other rooms

            // Finishing Level (from cost calculator)
            $table->enum('finishing_level', ['low', 'medium', 'high'])->default('medium')->after('other_rooms');

            // Additional Features (from cost calculator)
            $table->json('additional_features')->nullable()->after('finishing_level'); // garden, pool, elevator, basement

            // Additional Notes (from cost calculator)
            $table->text('additional_notes')->nullable()->after('additional_features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'floors',
                'majlis_count',
                'bedrooms',
                'guest_bedrooms',
                'bathrooms',
                'parking_spaces',
                'other_rooms',
                'finishing_level',
                'additional_features',
                'additional_notes'
            ]);
        });
    }
};
