@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-4">
    <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Cadastrar Novo Livro</h2>

        <form method="POST" action="{{ route('livros.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Título do Livro</label>
                <input type="text" name="titulo" required placeholder="Ex: O Senhor dos Anéis"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Autor</label>
                <input type="text" name="autor" required placeholder="Ex: J.R.R. Tolkien"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Categoria / Gênero</label>
                <input type="text" name="categoria" required placeholder="Ex: Fantasia, Romance, TI"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- 2. NOVO CAMPO: Capa do Livro --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Capa do Livro</label>
                <input type="file" name="capa" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-500 mt-1">Formatos aceitos: JPG, PNG. Máx: 2MB.</p>
            </div>

            <div class="mb-4">
                <label for="arquivo_pdf" class="block text-gray-700 font-bold mb-2">
                    Anexar Livro Digital (PDF):
                </label>
                <input type="file" 
                    name="arquivo_pdf" 
                    id="arquivo_pdf" 
                    accept="application/pdf" 
                    class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                <p class="text-xs text-gray-500 mt-1 italic">
                    * Campo opcional. Selecione o PDF caso deseje disponibilizar para download.
                </p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Quantidade de Exemplares</label>
                <input type="number" name="quantidade" min="1" required placeholder="Ex: 5"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('home') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium transition shadow-sm">
                    Salvar Livro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection