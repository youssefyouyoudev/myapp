<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

        public function up(): void
        {
            Schema::create('etudiants', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('full_name');
                $table->string('phone');
                $table->enum('status', ['active', 'suspended'])->default('active');
                $table->string('cin')->unique();
                $table->date('date_of_birth');
                $table->string('school');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('etudiants');
        }
    };
