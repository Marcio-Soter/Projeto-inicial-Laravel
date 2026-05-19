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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            // Relaciona com a tabela de usuários (o aluno que pegou)
            // Como sua tabela se chama 'usuarios', precisamos especificar o nome dela
            
            // $table->uuid('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->uuid('usuario_id'); // Cria a coluna para armazenar o UUID
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade'); // Cria a ligação
            
            // Relaciona com a tabela de livros
            $table->foreignId('livro_id')->constrained('livros')->onDelete('cascade');
            
            $table->date('data_emprestimo');
            $table->date('data_devolucao_prevista');
            $table->date('data_entrega_real')->nullable(); // Fica vazio até o aluno devolver
            $table->string('status')->default('ativo'); // 'ativo' ou 'devolvido'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
