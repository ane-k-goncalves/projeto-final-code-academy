<?php

namespace App\DTO;

use Illuminate\Http\Request; 

class UpdateOrderEtapaDTO
{
    public function __construct(
        public array $etapas  
    ) {}

    public static function makeFromRequest(Request $request): self
    {
        return new self($request->etapas);
    }
}
