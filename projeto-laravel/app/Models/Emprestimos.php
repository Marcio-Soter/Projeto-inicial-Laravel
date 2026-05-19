<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class emprestimos extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 
        'livro_id', 
        'data_emprestimo', 
        'data_devolucao_prevista', 
        'data_entrega_real', 
        'status'
    ];

    // Relacionamento: Um empréstimo pertence a um Livro
    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    // Relacionamento: Um empréstimo pertence a um Usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
