<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;

    protected $nome = 'etapas';    
    protected $fillable = ['name', 'funil_id', 'position'];

    public function funil()
    {
        return $this->belongsTo(Funil::class);
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }

}
