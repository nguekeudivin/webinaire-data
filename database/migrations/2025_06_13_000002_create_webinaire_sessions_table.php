<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinaire_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('date_session');
            $table->text('description')->nullable();
            $table->string('statut')->default('ouverte');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinaire_sessions');
    }
};
