<?php

namespace App\Observers;

use App\Models\Funil;
use App\Models\Etapa;


class FunilObserver
{
    /**
     * Handle the Explorador "created" event.
     *
     * @param  \App\Models\Funil  $explorador
     * @return void
     */
    public function created(Funil $funil)
    {
      
        $etapas = [
            ['position' => 1, 'name' => 'Sem etapa', 'funil_id' => $funil->id],
            ['position' => 2, 'name' => 'Prospecção', 'funil_id' => $funil->id],
            ['position' => 3, 'name' => 'Contato', 'funil_id' => $funil->id],
            ['position' => 4, 'name' => 'Proposta', 'funil_id' => $funil->id],
        ];

        
        Etapa::insert($etapas);
    }
}
