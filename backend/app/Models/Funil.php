<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funil extends Model
{
    use HasFactory;

    protected $nome = 'funils';    
    protected $fillable = ['name'];

    // Outros métodos, relações ou acessos adicionais conforme necessário
}