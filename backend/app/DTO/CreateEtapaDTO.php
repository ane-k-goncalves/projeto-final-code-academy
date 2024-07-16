<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateEtapaDTO
{
    public function __construct(
        public string $name,
        public string $funil_id // Adiciona o funil_id
    ) {}

    public static function makeFromRequest(Request $request, string $funilId): self
    {
        return new self(
            $request->name,
            $funilId
        );
    }
}
