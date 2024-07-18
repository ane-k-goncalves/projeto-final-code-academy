<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateEtapa;
use Illuminate\Http\Request;

class UpdateEtapaDTO
{
    public function __construct(
        public string $id,      
        public string $name,    
    ) {}

    public static function makeFromRequest(StoreUpdateEtapa $request): self
    {
        return new self(
            $request->route('id'),  
            $request->name       
        );
    }
}
