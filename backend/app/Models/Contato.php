<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $nome = 'contatos';    
    protected $fillable = ['name', 'etapa_id', 'position','telefone','email','cpf','data_de_nascimento','endereco','valor'];


    public function etapa()
    {
        return $this->belongsTo(Etapa::class);
    }


}
