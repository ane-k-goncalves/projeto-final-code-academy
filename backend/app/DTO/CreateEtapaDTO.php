<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateEtapaDTO
{
    public function __construct(
        public string $name,
        
    ) {}

    public static function makeFromRequest(array $data ): self
    {
        return new self(
            $data['name'],
          
        );
    }
}
