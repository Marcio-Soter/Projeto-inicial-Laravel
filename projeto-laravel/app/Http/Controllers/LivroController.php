<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LivroController extends Controller
{
    // 1. Exibe a tela com o formulário de cadastro
    public function create()
    {
        return view('livros.create');
    }

    // 2. Recebe os dados do formulário, valida e salva no banco
    public function store(Request $request)
    {
        // Validação para garantir que nenhum campo fique vazio ou incorreto
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:1',
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Valida se é imagem e tem até 2MB
            'arquivo_pdf' => 'nullable|mimes:pdf|max:10000', // Valida se é PDF até 10MB
    
        ]);


        $caminhoImagem = null;
        $caminhoPdf = null; // variável para o PDF


        // Lógica de Upload da Imagem
        if ($request->hasFile('capa')) {
            $imagem = $request->file('capa');
            
            // Gera um nome único: timestamp + extensão original
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            
            // Define o destino dentro de 'public/images/capas'
            $destino = public_path('images/capas');

            // Cria a pasta se ela não existir
            if (!File::isDirectory($destino)) {
                File::makeDirectory($destino, 0777, true, true);
            }

            // Move o arquivo para a pasta pública
            $imagem->move($destino, $nomeImagem);
            
            // Guarda o caminho relativo para salvar no banco
            $caminhoImagem = 'images/capas/' . $nomeImagem;
        }


        // 3. Lógica de Upload do PDF (Seguindo o teu padrão)
        if ($request->hasFile('arquivo_pdf')) {
            $pdf = $request->file('arquivo_pdf');
            
            // Gera nome único para o PDF
            $nomePdf = time() . '_conteudo.' . $pdf->getClientOriginalExtension();
            
            // Define o destino 'public/arquivos/pdfs'
            $destinoPdf = public_path('arquivos/pdfs');

            // Cria a pasta se não existir (mesma lógica que usaste para a capa)
            if (!File::isDirectory($destinoPdf)) {
                File::makeDirectory($destinoPdf, 0777, true, true);
            }

            // Move o PDF
            $pdf->move($destinoPdf, $nomePdf);
            
            // Caminho para o banco
            $caminhoPdf = 'arquivos/pdfs/' . $nomePdf;
        }




        // Cria o livro no banco de dados usando o Model
        Livro::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'categoria' => $request->categoria,
            'quantidade' => $request->quantidade,
            'capa' => $caminhoImagem, // Novo campo salvo aqui
            'arquivo_pdf' => $caminhoPdf, // Adicionamos o novo campo aqui
        ]);

        // Redireciona de volta para a Home com uma mensagem de sucesso
        return redirect()->route('home')->with('sucesso', 'Livro cadastrado com sucesso!');
    }


    public function solicitar($id)
    {
        $livro = \App\Models\Livro::findOrFail($id);

        // 1. Verificar se tem estoque
        if ($livro->quantidade <= 0) {
            return back()->with('erro', 'Este livro não está disponível no momento.');
        }

        // 2. Registrar o empréstimo seguindo sua migration
        DB::table('emprestimos')->insert([
            'usuario_id'              => session('usuario_id'), // O UUID do aluno
            'livro_id'                => $id,
            'data_emprestimo'         => Carbon::now(),
            'data_devolucao_prevista' => Carbon::now()->addDays(7), // Prazo de uma semana
            'status'                  => 'ativo',
            'created_at'              => now(),
            'updated_at'              => now(),
        ]);

        // 3. Baixar o estoque do livro
        $livro->decrement('quantidade');

        return redirect()->route('home')->with('sucesso', 'Livro solicitado! Devolva em até 7 dias.');
    }


    public function edit($id)
    {

        // Se não estiver logado, manda pra home com erro:
        if (!session('usuario_id')) {
            return redirect()->route('home')->with('erro', 'Acesso negado! Você precisa ser ADM.');
        }

        $livro = Livro::findOrFail($id);
        return view('livros.edit', compact('livro'));
    }



    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);

        // 1. Apaga a imagem física da pasta public/images/capas
        if ($livro->capa && File::exists(public_path($livro->capa))) {
            File::delete(public_path($livro->capa));
        }

        // 2. Apaga o registro do banco de dados
        $livro->delete();

        return redirect()->route('home')->with('sucesso', 'Livro removido com sucesso!');
    }

    public function update(Request $request, $id)
{
    // 1. Encontra o livro no banco
    $livro = Livro::findOrFail($id);

    // 2. Validação simples
    $request->validate([
        'titulo' => 'required',
        'autor' => 'required',
        'categoria' => 'required',
        'quantidade' => 'required|integer',
        'capa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'arquivo_pdf' => 'nullable|mimes:pdf|max:10000',
    ]);

    // 3. Atualiza os dados (exceto a imagem por enquanto para não dar erro)
    $livro->update([
        'titulo' => $request->titulo,
        'autor' => $request->autor,
        'categoria' => $request->categoria,
        'quantidade' => $request->quantidade,
        
    ]);

    // 4. Lógica para atualizar a CAPA (se você enviou uma nova foto)
    if ($request->hasFile('capa')) {
        $nomeCapa = time() . '.' . $request->capa->extension();
        $request->capa->move(public_path('images/livros'), $nomeCapa);
        $livro->capa = 'images/livros/' . $nomeCapa;
        $livro->save();
    }

    // 5. Lógica para atualizar o PDF (Seguindo o mesmo padrão do seu Store)
    if ($request->hasFile('arquivo_pdf')) {
        $pdf = $request->file('arquivo_pdf');
        
        // Mantendo o padrão de nomeação que fizemos no Store
        $nomePdf = time() . '_conteudo.' . $pdf->getClientOriginalExtension();
        
        $destinoPdf = public_path('arquivos/pdfs');

        // Cria a pasta se não existir, como você fez no Store
        if (!File::isDirectory($destinoPdf)) {
            File::makeDirectory($destinoPdf, 0777, true, true);
        }

        $pdf->move($destinoPdf, $nomePdf);
        
        // Atualiza o caminho no banco
        $livro->arquivo_pdf = 'arquivos/pdfs/' . $nomePdf;
        $livro->save();
    }

    return redirect()->route('home')->with('sucesso', 'Livro atualizado com sucesso!');
}

}
