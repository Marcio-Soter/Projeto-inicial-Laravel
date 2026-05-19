<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model 
{
    //
    // Define quais campos o Laravel tem permissão para salvar direto no banco
    protected $fillable = ['titulo', 'autor', 'categoria', 'quantidade' , 'capa', 'arquivo_pdf'];

}
