<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB; // Importante para inserir dados
use Illuminate\Support\Str;        // Importante para gerar o UUID
use Illuminate\Support\Facades\Hash; // Importante se você usa criptografia de senha

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('usuarios')->updateOrInsert([
            'id' => Str::uuid(),
            'nome' => 'Marcio',
            'email' => 'marciovieirabrito@gmail.com',
            // Se o seu sistema usa senhas criptografadas, use: Hash::make('123')
            // Se o seu sistema salva a senha como texto puro, use apenas: '123'
            'senha' => Hash::make('123456') , 
            'tipo' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('usuarios')->where('email', 'admin@admin.com')->delete();
    }
};
