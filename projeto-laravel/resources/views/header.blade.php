<header class="bg-gray-800 text-white py-5 border-b border-gray-700 shadow-md">
    <div class="max-w-5xl mx-auto px-4 flex justify-between items-center">

        {{-- Logo/Título com imagem acima --}}
<h1 class="text-xl font-extrabold tracking-tight">
    <a href="{{ route('home') }}" class="flex flex-col items-center md:items-start hover:text-gray-300 transition-colors">
        
        {{-- A sua imagem aqui --}}
        <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-[150px] w-auto mb-1">
        
        <span>
            Biblioteca Virtual<span class="text-green-500"></span>
        </span>
    </a>
</h1>

        <nav class="flex items-center gap-6">

            {{-- Links de Navegação --}}
            <div class="hidden md:flex items-center gap-4 text-sm font-medium text-gray-300">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                    Home
                </a>

                @if(session('usuario_tipo') === 'admin')
                    <a href="{{ route('usuarios.index') }}" class="hover:text-white transition-colors">
                        Usuários
                    </a>
                @endif
            </div>

            {{-- Divisor Vertical Sutil --}}
            <div class="h-6 w-[1px] bg-gray-700 hidden md:block"></div>

            {{-- Ações e Auth --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('usuarios.create') }}" class="bg-green-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-500 transition-all shadow-sm">
                    Cadastrar
                </a>

                @if(session('usuario_id'))
                    <div class="flex items-center gap-3 ml-2 border-l border-gray-700 pl-4">
                        <span class="text-xs text-gray-400 hidden sm:inline">
                            Olá, <b class="text-white">{{ session('usuario_nome') }}</b>
                        </span>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button class="bg-red-600/20 text-red-400 border border-red-600/50 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600 hover:text-white transition-all">
                                Sair
                            </button>
                        </form>
                    </div>
                @else
                    <button onclick="abrirModal()" class="bg-blue-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-500 transition-all shadow-sm">
                        Login
                    </button>
                @endif
            </div>

        </nav>
    </div>
</header>