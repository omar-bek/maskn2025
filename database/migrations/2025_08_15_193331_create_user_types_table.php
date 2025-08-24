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
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // client, consultant, contractor, supplier
            $table->string('display_name_ar'); // عميل، استشاري، مقاول، مورد
            $table->string('display_name_en'); // Client, Consultant, Contractor, Supplier
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
