<?php

namespace App\DTO;

use App\Http\Request\StoreUpdateFunil;
use Illuminate\Support\Facades\Auth;

class CreateFunilDTO
{
    public function __construct(
        public string $name,
        public ?int $userId = null
    ) {}

    public static function makeFromRequest(StoreUpdateFunil $request): self
    {
        $user = Auth::user();
        
        if (!$user) {
            throw new \Exception('Usuário não autenticado.');
        }
        
        return new self(
            name: $request->input('name'),
            userId: $user->id // Certifique-se de que o usuário está autenticado
        );
    }
}
