<?php

namespace App\DTO;

use App\Http\Request\StoreUpdateEtapa;


class UpdateEtapaDTO
{
    public function __construct(  
        public string $name,    
    ) {}

    public static function makeFromRequest(array $data): self
    {
        return new self(
             
            $data['name']       
        );
    }
}
