<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class UpdateContatoDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public int $ddd,
        public string $email,
        public string $endereco,
        public string $data_de_nascimento,
        public float $valor,
        public string $telefone
    ) {}

    public static function makeFromRequest(Request $request): self
    {
        return new self(
            $request->route('id'),
            $request->name,
            $request->email,
            $request->endereco,
            $request->ddd,
            $request->data_de_nascimento,
            $request->valor,
            $request->telefone


        );
    }
}
