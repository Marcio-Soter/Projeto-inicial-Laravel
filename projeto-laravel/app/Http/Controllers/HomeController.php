<?php

namespace App\Http\Controllers;

use App\Models\livro;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index()
    // {
    //     return view('home');
        
    // }

    public function index(Request $request)
    {
        // Iniciamos uma consulta na tabela de livros
        $query = Livro::query();

        // 1. FILTRO DE BUSCA (Por título ou autor)
        if ($request->has('busca') && $request->busca != '') {
            $query->where(function($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->busca . '%')
                  ->orWhere('autor', 'like', '%' . $request->busca . '%');
            });
        }

        // 2. FILTRO DE CATEGORIA
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('categoria', $request->categoria);
        }

        // Pegamos os livros já filtrados (ou todos, se nenhum filtro foi usado)
        $livros = $query->get();

        // Pegamos apenas as categorias que existem no banco para montar o select na tela
        $categorias = Livro::pluck('categoria')->unique();

        // Mandamos os livros e as categorias para a view 'home'
        return view('home', compact('livros', 'categorias'));
    }

}
