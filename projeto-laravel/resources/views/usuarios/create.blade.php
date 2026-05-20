@extends('layout')

@section('content')

<div class="min-h-[80vh] flex items-center justify-center p-6">
    
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
        
        {{-- Cabeçalho do Card --}}
            {{-- Cabeçalho do Card Centralizado --}}
        <div class="bg-gray-800 p-8 flex flex-col items-center justify-center text-center">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" 
                class="h-20 w-auto mb-4 mx-auto block brightness-110">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Criar Novo Usuário</h1>
            <p class="text-gray-400 text-sm mt-1">Preencha os dados para liberar o acesso ao sistema</p>
        </div>

        {{-- Corpo do Formulário --}}
        <div class="p-8">
            <form method="POST" action="/usuarios" class="space-y-6">
                @csrf

                {{-- Campo Nome --}}
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Nome Completo</label>
                    <input type="text" name="nome" placeholder="Digite o nome completo" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 transition-all placeholder:text-gray-400">
                </div>

                {{-- Campo Email --}}
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Endereço de E-mail</label>
                    <input type="email" name="email" placeholder="exemplo@email.com" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 transition-all placeholder:text-gray-400">
                </div>

                {{-- Campo Senha --}}
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-1">Senha de Acesso</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 transition-all placeholder:text-gray-400">
                </div>

                {{-- Ações --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 transition-all shadow-lg active:transform active:scale-95 text-center">
                        Salvar Cadastro
                    </button>
                    
                    <a href="{{ route('usuarios.index') }}" 
                       class="flex-1 bg-gray-100 text-gray-600 font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-all text-center">
                        Voltar para Lista
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection