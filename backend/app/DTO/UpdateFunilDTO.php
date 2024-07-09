<?php

namespace App\DTO;


use App\Http\Requests\StoreUpdateFunil;

Class UpdateFunilDTO{

public function __construct(
    public string $id,
    public string $name
   
){}

public static function makeFromRequest(StoreUpdateFunil $request){
    return new self(
        $request->id,
        $request->name
       
    );
}

}