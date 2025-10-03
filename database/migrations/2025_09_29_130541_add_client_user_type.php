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
        // Add client user type
        DB::table('user_types')->insert([
            'name' => 'client',
            'display_name_ar' => 'عميل',
            'display_name_en' => 'Client',
            'description_ar' => 'عميل يبحث عن خدمات التصميم والبناء',
            'description_en' => 'Client looking for design and construction services',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('user_types')->where('name', 'client')->delete();
    }
};
