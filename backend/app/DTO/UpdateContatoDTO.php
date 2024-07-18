<?php

namespace App\DTO;

use App\Http\Request\StoreUpdateContato;
use Illuminate\Http\Request;

class UpdateContatoDTO
{
    public function __construct(
        public string $id,
        public string $etapaId,
        public string $name,
        public string $telefone,
        public string $email,
        public string $data_de_nascimento,
        public float $valor,
        public string $ddd, 
        public string $endereco  
    ) {}
    public static function makeFromRequest(array $data): self
    {
        return new self(
            $data['id'] ?? '', // Adicionando valor padrão vazio
            $data['etapaId'] ?? '', // Adicionando valor padrão vazio
            $data['name'] ?? '',
            $data['telefone'] ?? '',
            $data['email'] ?? '',
            $data['data_de_nascimento'] ?? '',
            (float)($data['valor'] ?? 0.0),
            $data['ddd'] ?? '',
            $data['endereco'] ?? ''
        );
    }
}