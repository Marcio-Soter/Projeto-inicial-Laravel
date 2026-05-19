<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Livros extends Seeder
{
        /**
         * Run the database seeds.
         */
        public function run(): void
    {
        // 1. O Acervo de Livros organizado por categoria
        $categorias = [
            'Tecnologia' => ['Estudando a Mente de Morainstein Vol I', 'Clean Code', 'Laravel Design Patterns', 'JavaScript Moderno', 'Refatoração', 'Docker'],
            'Literatura' => ['Dom Casmurro', 'O Cortico', 'Iracema', 'Capitães da Areia', 'Memórias Póstumas'],
            'Suspense'   => ['Sherlock Holmes', 'Psicose', 'O Iluminado', 'Drácula', 'O Corvo'],
            'História'   => ['Sapiens', '1808', 'A Era dos Extremos', 'Raízes do Brasil', 'O Egito Antigo']
        ];

        // 2. O Loop que faz a mágica acontecer
        foreach ($categorias as $categoria => $titulos) {
            foreach ($titulos as $titulo) {
                
                // Definimos onde os arquivos DEVERIAM estar
                $caminhoCapa = "arquivos/capas/{$titulo}.jpg";
                $caminhoPdf  = "arquivos/pdfs/{$titulo}.pdf";

                // Lógica do "Default": Se o arquivo não existir na pasta, ele usa o padrão
                // public_path() busca o caminho real no disco (C:\Users\...)
                $capaFinal = file_exists(public_path($caminhoCapa)) 
                            ? $caminhoCapa 
                            : 'arquivos/capas/default.jpg';

                $pdfFinal  = file_exists(public_path($caminhoPdf)) 
                            ? $caminhoPdf 
                            : null;

                // 3. Inserção no Banco de Dados
                DB::table('livros')->insert([
                    'titulo'      => $titulo,
                    'autor'       => 'Autor Exemplo',
                    'categoria'   => $categoria,
                    'quantidade'  => rand(1, 20), // Estoque aleatório para parecer real
                    'capa'        => $capaFinal,
                    'arquivo_pdf' => $pdfFinal,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}