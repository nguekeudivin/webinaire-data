<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('webinaire_sessions')->onDelete('cascade');
            $table->string('nom');
             $table->string('email');
            $table->string('prenom')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('secteur')->nullable();
            $table->string('profil')->nullable();
            $table->string('niveau')->nullable();
            $table->string('accompagnement')->nullable();
            $table->tinyInteger('note');
            $table->text('commentaire')->nullable();
            $table->timestamp('date_avis')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
