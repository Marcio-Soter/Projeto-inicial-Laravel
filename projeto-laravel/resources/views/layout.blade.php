<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>

    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}">

    {{-- Google Fonts - Material Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    {{-- Vite: Carrega o CSS e JS processados (incluindo o Tailwind e o app.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-blue-80 text-gray-900 antialiased">

    @include('header')

    {{-- BLOCO DE MENSAGENS DE FEEDBACK --}}
    <div class="max-w-5xl mx-auto mt-4 px-4 w-full">
        @if(session('erro'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                <strong class="font-bold">Aviso:</strong>
                <span class="block sm:inline">{{ session('erro') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Barra de Ações para Admin --}}
        @if(session('usuario_tipo') === 'admin')
            <div class="flex flex-wrap gap-4 bg-gray-800 p-3 rounded-xl shadow-md mb-6">
                <a href="{{ route('livros.create') }}" class="text-white hover:text-blue-400 transition font-medium px-2">
                    + Novo Livro
                </a>
                <a href="{{ route('usuarios.index') }}" class="text-white hover:text-blue-400 transition font-medium border-l border-gray-600 pl-4">
                    Usuários
                </a>
                <a href="{{ route('emprestimos.index') }}" class="text-white hover:text-blue-400 transition font-medium border-l border-gray-600 pl-4">
                    Gerenciar Empréstimos
                </a>
            </div>
        @endif
    </div>

    {{-- CONTEÚDO PRINCIPAL (HOME) --}}
    <main class="flex-grow">
        <div class="p-4">
            @yield('content')
        </div>
    </main>

    @include('footer')

    {{-- ================================================================= --}}
    {{-- MODAL DE LOGIN (Posicionado no fim para sobrepor tudo) --}}
    {{-- ================================================================= --}}
    <div id="loginModal" class="hidden fixed inset-0 z-[9999] w-full h-full flex items-center justify-center p-4" 
         style="background-color: rgba(0, 0, 0, 0.75); backdrop-filter: blur(4px);">
        
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 transform transition-all border border-gray-100">
            
            <button id="btn-fechar-login" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
                <span class="text-2xl font-bold">✕</span>
            </button>

            <div class="flex flex-col items-center justify-center w-full mb-6">
                <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-24 w-auto mb-4 block mx-auto">
                <h2 class="text-3xl font-extrabold text-center text-gray-900 tracking-tight">
                    Login
                </h2>
            </div>

            <form method="POST" action="/login">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">E-mail</label>
                    <input type="email" name="email" placeholder="exemplo@email.com" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 transition-all">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Senha</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 transition-all">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 transition-all shadow-lg active:transform active:scale-95">
                    Entrar 
                </button>
            </form>
        </div>
    </div>

</body>
</html>