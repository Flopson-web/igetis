<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->string('tipo')->nullable()->after('slug');
            $table->date('fecha_inicio')->nullable()->after('tipo');
            $table->date('fecha_fin')->nullable()->after('fecha_inicio');
            $table->json('precios')->nullable()->after('fecha_fin');
            $table->json('agenda')->nullable()->after('precios');
            $table->json('docentes_curso')->nullable()->after('agenda');
            $table->string('certificacion')->nullable()->after('docentes_curso');
        });
    }

    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'fecha_inicio', 'fecha_fin', 'precios', 'agenda', 'docentes_curso', 'certificacion']);
        });
    }
};
