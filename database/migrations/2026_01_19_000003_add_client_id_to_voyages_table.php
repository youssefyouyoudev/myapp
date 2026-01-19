<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('voyages', function (Blueprint $table) {
            $table->foreignId('client_id')->after('card_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });
    }
};
