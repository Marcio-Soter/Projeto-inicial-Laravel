@extends('layout')

@section('content')

<div class="max-w-5xl mx-auto p-6">
    
    {{-- Cabeçalho da Página --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Lista de Usuários</h1>
            <p class="text-gray-500">Gerencie os membros da sua biblioteca</p>
        </div>
        <a href="{{ route('home') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl font-bold hover:bg-gray-200 transition-all">
            Voltar
        </a>
    </div>

    {{-- Grid de Usuários --}}
    <div class="grid gap-4">
        @foreach ($usuarios as $u)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-2 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                
                <div class="flex items-center gap-4">
                    {{-- Ícone de Avatar --}}
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $u->nome }}</h3>
                        <p class="text-gray-500 text-sm">{{ $u->email }}</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    {{-- Botão Editar --}}
                    <a href="{{ route('usuarios.edit', $u->id) }}" 
                       class="flex items-center gap-1 bg-blue-50 text-blue-600 px-4 py-2 rounded-xl font-bold hover:bg-blue-600 hover:text-white transition-all text-sm">
                        <span class="material-symbols-outlined text-sm">edit</span> 
                    </a>

                    {{-- Botão Excluir --}}
                    <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                        @csrf
                        @method('DELETE')
                        <button class="flex items-center gap-1 bg-red-50 text-red-600 px-4 py-2 rounded-xl font-bold hover:bg-red-600 hover:text-white transition-all text-sm">
                            <span class="material-symbols-outlined text-sm">delete</span> 
                        </button>
                    </form>
                </div>

            </div>
        @endforeach
    </div>

    @if($usuarios->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
            <p class="text-gray-500 font-medium">Nenhum usuário cadastrado até o momento.</p>
        </div>
    @endif

</div>

@endsection