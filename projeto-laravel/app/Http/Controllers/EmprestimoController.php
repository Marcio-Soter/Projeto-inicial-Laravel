<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Emprestimos;
use App\Models\Livro;

class EmprestimoController extends Controller
{
    // Listar todos os empréstimos (Para o Admin)
    public function index()
    {
        // Carrega os empréstimos com os dados do livro e do usuário (Relacionamentos)
        $emprestimos = Emprestimos::with(['livro', 'usuario'])->orderBy('created_at', 'desc')->get();
        return view('emprestimos.index', compact('emprestimos'));
    }

    // O Usuário solicita o livro (Botão da Home)
    public function store($id)
    {
        $livro = Livro::findOrFail($id);

        // 1. Verifica se tem estoque
        if ($livro->quantidade <= 0) {
            return back()->with('erro', 'Este livro está esgotado no momento!');
        }

        // 2. Cria o empréstimo
        Emprestimos::create([
            'usuario_id' => session('usuario_id'), // Pega o ID de quem está logado
            'livro_id' => $livro->id,
            'data_emprestimo' => now(),
            'data_devolucao_prevista' => now()->addDays(7), // Prazo de 7 dias
            'status' => 'ativo'
        ]);

        // 3. Diminui 1 unidade do estoque do livro
        $livro->decrement('quantidade');

        return redirect()->route('home')->with('sucesso', 'Solicitação realizada! Retire o livro na biblioteca.');
    }

    // O Admin confirma a devolução
    public function devolver($id)
    {
        $emprestimo = Emprestimos::findOrFail($id);

        if ($emprestimo->status === 'devolvido') {
            return back()->with('erro', 'Este item já consta como devolvido.');
        }

        // 1. Atualiza o status
        $emprestimo->update([
            'status' => 'devolvido',
            'data_entrega_real' => now()
        ]);

        // 2. Devolve a unidade para o estoque do livro
        $emprestimo->livro->increment('quantidade');

        return back()->with('sucesso', 'Devolução registrada com sucesso!');
    }
}
