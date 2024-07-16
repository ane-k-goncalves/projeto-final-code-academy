<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdateEtapaDTO
{
    public function __construct(
        public string $id,      
        public string $name,    
    ) {}

    public static function makeFromRequest(Request $request): self
    {
        return new self(
            $request->route('id'),  
            $request->name       
        );
    }
}
