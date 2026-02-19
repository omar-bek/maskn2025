<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (Schema::hasTable('tenders')) {
        Schema::table('tenders', function (Blueprint $table) {
            $table->text('client_notes')->nullable();
        });
    }
}


    /**
     * Reverse the migrations.
     */
   public function down()
{
    if (Schema::hasTable('tenders')) {
        Schema::table('tenders', function (Blueprint $table) {
            $table->dropColumn('client_notes');
        });
    }
}

};

