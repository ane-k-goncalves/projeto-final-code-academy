<?php

namespace App\DTO;


use App\Http\Requests\StoreUpdateFunil;

Class CreateFunilDTO{

public function __construct(
    public string $name,

){}

public static function makeFromRequest(StoreUpdateFunil $request){
    return new self(
        $request->nome
    );
}

}