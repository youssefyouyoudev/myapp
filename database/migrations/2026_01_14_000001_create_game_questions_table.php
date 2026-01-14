<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('game_questions', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // sex-life, house, outside, all-life
            $table->string('question', 512);
            $table->string('emoji', 8)->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('game_questions');
    }
};
