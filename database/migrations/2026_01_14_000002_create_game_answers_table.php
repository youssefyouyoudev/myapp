<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('game_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->string('player_name');
            $table->text('answer');
            $table->timestamps();
            $table->foreign('question_id')->references('id')->on('game_questions')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('game_answers');
    }
};
