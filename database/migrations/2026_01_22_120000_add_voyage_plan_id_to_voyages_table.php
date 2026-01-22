<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->unsignedBigInteger('voyage_plan_id')->nullable()->after('client_id');
            $table->foreign('voyage_plan_id')->references('id')->on('voyage_plans')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropForeign(['voyage_plan_id']);
            $table->dropColumn('voyage_plan_id');
        });
    }
};
