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
                $table->string('nom');
                $table->string('prenom');
                $table->string('etablissement');
                $table->string('email')->unique();
                $table->string('telephone');
                $table->string('adresse')->nullable();
                $table->string('carte_nationale')->unique();
                $table->string('carte_etudiant')->nullable();
                $table->string('img_user')->nullable();
                $table->string('img_carte_nationale')->nullable();
                $table->string('img_carte_nationale_verso')->nullable();
                $table->string('img_carte_etudiant')->nullable();
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
