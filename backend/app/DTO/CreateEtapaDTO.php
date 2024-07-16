<?php

namespace App\DTO;


use App\Http\Requests\StoreUpdateEtapa;

Class CreateEtapaDTO{

public function __construct(
    public string $name,
    public int $position,
    public int $funil_id,
){}

public static function makeFromRequest(StoreUpdateEtapa $request){
    return new self(
        $request->name,
        $request->position,
        $request->funil_id
    );
}

}