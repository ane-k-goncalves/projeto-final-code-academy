<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateContatoDTO
{

    public function __construct(
        public string $name,
        public string $etapa_id,
        public string $telefone,
        public string $email,
        public string $data_de_nascimento,
        public float $valor,
        public int $ddd,
        public string $cpf,
        public string $endereco


    ) {}

    public static function makeFromRequest(Request $request, string $EtapaId): self
    {
        return new self(
            $request->name,
            $EtapaId,
            $request->telefone,
            $request->email,
            $request->data_de_nascimento,
            $request->valor,
            $request->ddd,
            $request->cpf,
            $request->endereco

        );
    }
}
