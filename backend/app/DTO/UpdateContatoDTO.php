<?php

namespace App\DTO;


class UpdateContatoDTO
{
    public function __construct(
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
            $data['name'],
            $data['telefone'],
            $data['email'],
            $data['data_de_nascimento'],
            (float)($data['valor']),
            $data['ddd'],
            $data['endereco']
        );
    }
}