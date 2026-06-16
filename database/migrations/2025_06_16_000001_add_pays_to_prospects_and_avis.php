<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prospects', function (Blueprint $table) {
            $table->string('pays')->nullable()->after('whatsapp');
        });

        Schema::table('avis', function (Blueprint $table) {
            $table->string('pays')->nullable()->after('whatsapp');
        });
    }

    public function down(): void
    {
        Schema::table('prospects', function (Blueprint $table) {
            $table->dropColumn('pays');
        });

        Schema::table('avis', function (Blueprint $table) {
            $table->dropColumn('pays');
        });
    }
};
