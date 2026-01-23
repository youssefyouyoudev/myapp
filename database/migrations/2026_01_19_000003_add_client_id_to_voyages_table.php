<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('voyages', function (Blueprint $table) {
            $table->foreignId('etudiant_id')->after('card_id')->nullable()->constrained('etudiants')->onDelete('set null');
        });
    }
    public function down(): void {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropForeign(['etudiant_id']);
            $table->dropColumn('etudiant_id');
        });
    }
};
