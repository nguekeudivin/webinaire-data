<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('secteur');
            $table->string('profil');
            $table->string('niveau');
             $table->string('preference');
            $table->boolean('consentement')->default(true);
            $table->timestamp('date_inscription')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
