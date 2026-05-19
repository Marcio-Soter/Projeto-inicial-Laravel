@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Livro</h2>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="space-y-4">
            {{-- Título --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" value="{{ $livro->titulo }}" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- Autor --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" name="autor" value="{{ $livro->autor }}" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Categoria</label>
                    <input type="text" name="categoria" value="{{ $livro->categoria }}" class="w-full border rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Quantidade</label>
                    <input type="number" name="quantidade" value="{{ $livro->quantidade }}" class="w-full border rounded-lg px-4 py-2" required>
                </div>
            </div>

            {{-- Gestão da Capa --}}
            <div class="border-t pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Capa do Livro</label>
                @if($livro->capa)
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ asset($livro->capa) }}" class="w-16 h-20 object-cover rounded shadow">
                        <span class="text-xs text-gray-500 italic">Capa atual carregada</span>
                    </div>
                @endif
                <input type="file" name="capa" accept="image/*" class="w-full text-sm">
                <p class="text-xs text-gray-400 mt-1">Selecione uma imagem apenas se desejar trocar a atual.</p>
            </div>

            {{-- NOVO: Gestão do PDF --}}
            <div class="border-t pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Arquivo Digital (PDF)</label>
                
                @if($livro->arquivo_pdf)
                    <div class="flex items-center gap-2 mb-2 text-green-600">
                        <span class="text-xl">📄</span>
                        <span class="text-xs font-semibold">Este livro já possui um PDF cadastrado.</span>
                    </div>
                @endif

                <input type="file" name="arquivo_pdf" accept="application/pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-400 mt-1">Suba um novo arquivo PDF para adicionar ou substituir o atual.</p>
            </div>

            <div class="flex gap-4 pt-6 border-t">
                <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">Salvar Alterações</button>
                <a href="{{ route('home') }}" class="flex-1 bg-gray-100 text-gray-700 text-center py-2 rounded-lg hover:bg-gray-200 transition">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection