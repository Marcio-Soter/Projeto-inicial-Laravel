@extends('layout')

@section('content')

{{-- Banner de Boas-vindas --}}
<div class="h-64 flex flex-col items-center justify-center p-6 text-center bg-cover bg-center text-white shadow-md"
     style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/166.jpg');">
     
    <h1 class="text-4xl font-bold mb-2 tracking-wide">
        Bem-vindo à Biblioteca Virtual
    </h1>
    
    <p class="text-gray-200 text-lg">
        Explore nosso acervo, faça buscas e gerencie seus empréstimos.
    </p>
</div>

<div class="max-w-6xl mx-auto mt-8 px-4 pb-12">

    {{-- Alertas de Feedback --}}
    @if(session('erro'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
            {{ session('erro') }}
        </div>
    @endif

    @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
            {{ session('sucesso') }}
        </div>
    @endif

    {{-- Filtro de Busca --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-8">
        <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
            
            <div class="flex-1">
                <input type="text" name="busca" value="{{ request('busca') }}" 
                       placeholder="Buscar por título ou autor..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50 text-gray-800">
            </div>

            <div class="w-full md:w-64">
                <select name="categoria" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas as Categorias</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium transition shadow-sm">
                    Filtrar
                </button>
                
                @if(request('busca') || request('categoria'))
                    <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 font-medium text-center transition shadow-sm">
                        Limpar
                    </a>
                @endif
            </div>
        </form>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2 flex justify-between items-center">
        <span>Livros Disponíveis</span>
        <span class="text-sm font-normal text-gray-500">Total: {{ $livros->count() }} resultado(s)</span>
    </h2>

    {{-- Grid de Livros --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($livros as $livro)
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 flex flex-col justify-between hover:shadow-lg transition">

                {{-- Capa do Livro --}}
                <div class="w-full h-48 mb-4 overflow-hidden rounded-lg bg-gray-100">
                    @if($livro->capa)
                        <img src="{{ asset($livro->capa) }}" class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 italic font-serif">Sem capa</div>
                    @endif
                </div>

                {{-- Informações --}}
                <div>
                    <span class="bg-blue-50 text-blue-600 text-xs font-bold uppercase px-2.5 py-1 rounded-md tracking-wide">
                        {{ $livro->categoria }}
                    </span>
                    
                    <h3 class="text-xl font-bold text-gray-900 mt-3 leading-snug h-14 overflow-hidden">
                        {{ $livro->titulo }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mt-1 italic">
                        Por: {{ $livro->autor }}
                    </p>
                </div>
                
                {{-- Status e Solicitação --}}
                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                    @if($livro->quantidade > 0)
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full">
                            Disponível ({{ $livro->quantidade }})
                        </span>
                        
                        {{-- Botão Solicitar visível para qualquer logado --}}
                        @if(session('usuario_id'))
                        <form action="{{ route('emprestimos.store', $livro->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm">
                                Solicitar
                            </button>
                        </form>
                        @endif
                    @else
                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full">
                            Esgotado
                        </span>
                    @endif
                </div>

                {{-- Botões de Gestão (SÓ ADMIN VÊ) --}}
                @if(session('usuario_tipo') === 'admin')
                <div class="flex gap-2 mt-4 border-t pt-4">
                    <a href="{{ route('livros.edit', $livro->id) }}" 
                       class="flex-1 text-center bg-yellow-500 text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-yellow-600 transition shadow-sm">
                       Editar
                    </a>

                    <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-red-700 transition shadow-sm">
                            Excluir
                        </button>
                    </form>
                </div>
                @endif

            </div>
        @empty
            <div class="col-span-full bg-gray-50 p-12 rounded-xl text-center border border-dashed border-gray-300">
                <p class="text-gray-500 text-lg">Nenhum livro foi encontrado.</p>
                <a href="{{ route('home') }}" class="text-blue-600 underline font-medium mt-2 inline-block">Limpar busca</a>
            </div>
        @endforelse
    </div>

</div>

@endsection