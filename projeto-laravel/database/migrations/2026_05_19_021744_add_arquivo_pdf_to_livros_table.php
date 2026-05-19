<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('livros', function (Blueprint $table) {
        // Adiciona a coluna arquivo_pdf logo após a coluna capa:    
        $table->string('arquivo_pdf')->nullable()->after('capa'); // nullable() é essencial porque nem todo livro pode ter PDF.
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livros', function (Blueprint $table) {
            $table->dropColumn('arquivo_pdf'); //Caso eu precise de rollback
        });
    }
};
