<footer class="bg-gray-800 text-white py-12 mt-auto border-t border-gray-700">
    <div class="max-w-5xl mx-auto px-4">
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">
            
            {{-- Lado Esquerdo: Info do Sistema --}}
            <div class="text-center md:text-left">
                <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-14 w-auto mb-3 opacity-80 hover:opacity-100 transition-opacity">
                <h2 class="text-xl font-bold mb-2 text-white">Biblioteca Virtual</h2>
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Todos os direitos reservados.
                </p>
            </div>

            {{-- Lado Direito: Links Rápidos --}}
            <div class="flex gap-6 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <a href="#" class="hover:text-white transition-colors">Privacidade</a>
                <a href="#" class="hover:text-white transition-colors">Suporte</a>
            </div>

        </div>

        {{-- Divisor --}}
        <hr class="my-8 border-gray-700">

        {{-- Destaque do Desenvolvedor --}}
        <div class="text-center">
            <p class="text-gray-400 text-sm italic">
                Desenvolvido por 
                <span class="text-green-400 font-mono font-bold text-base block md:inline mt-1 md:mt-0">
                    &lt;Marcio Vieira/&gt;
                </span>
            </p>
        </div>

    </div>
</footer>