import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    
    // --- LÓGICA DO TÍTULO ROTATIVO ---
    const tituloBiblioteca = document.querySelector('#titulo-biblioteca');
    if (tituloBiblioteca) {
        const frases = [
            "Bem-vindo à Biblioteca Virtual",
            "Explore o nosso universo de histórias",
            "Encontre o seu próximo livro favorito",
            "Solicite um livro do nosso estoque, ou faça download",
            "Conhecimento ao alcance de um clique"
        ];
        let indice = 0;
       setInterval(() => {
            // 1. Inicia o Fade Out (Leva 500ms para sumir)
            tituloBiblioteca.classList.replace('opacity-100', 'opacity-0');

            // 2. Esperamos o texto sumir completamente (500ms) para trocar a frase
            setTimeout(() => {
                indice = (indice + 1) % frases.length;
                tituloBiblioteca.textContent = frases[indice];

                // 3. Inicia o Fade In (Leva 500ms para aparecer)
                tituloBiblioteca.classList.replace('opacity-0', 'opacity-100');
            }, 600); // 600ms garante que o texto já sumiu antes da troca
            
        }, 4000); // Aumentei para 4 segundos para a leitura ficar mais confortável
    }

    // --- LÓGICA DO MODAL DE LOGIN ---
    const modal = document.getElementById('loginModal');
    const btnAbrir = document.querySelector('#btn-abrir-login'); // Precisamos colocar esse ID no seu botão
    const btnFechar = document.querySelector('#btn-fechar-login'); // E esse no de fechar

    if (modal && btnAbrir) {
        btnAbrir.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    }

    if (modal && btnFechar) {
        btnFechar.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }
});