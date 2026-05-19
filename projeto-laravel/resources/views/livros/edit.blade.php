@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Livro</h2>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" value="{{ $livro->titulo }}" class="w-full border rounded-lg px-4 py-2" required>
            </div>

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

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Capa Atual</label>
                @if($livro->capa)
                    <img src="{{ asset($livro->capa) }}" class="w-20 mb-2 rounded shadow">
                @endif
                <input type="file" name="capa" class="w-full text-sm">
                <p class="text-xs text-gray-500 mt-1">Deixe vazio se não quiser trocar a foto.</p>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700">Salvar</button>
                <a href="{{ route('home') }}" class="flex-1 bg-gray-200 text-center py-2 rounded-lg">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection