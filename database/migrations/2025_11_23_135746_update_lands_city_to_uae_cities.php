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
        Schema::table('lands', function (Blueprint $table) {
            // تغيير عمود city من enum إلى string لدعم المدن الإماراتية
            $table->string('city', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lands', function (Blueprint $table) {
            // إعادة enum للمدن السعودية (للرجوع للخلف)
            $table->enum('city', ['riyadh', 'jeddah', 'dammam', 'makkah', 'medina', 'taif', 'abha', 'jubail', 'yanbu', 'other'])->change();
        });
    }
};
