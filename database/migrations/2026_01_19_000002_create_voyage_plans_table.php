<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('voyage_plans', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->integer('number_of_voyages');
            $table->enum('expiration', ['6_month', '1_year']);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('voyage_plans');
    }
};
