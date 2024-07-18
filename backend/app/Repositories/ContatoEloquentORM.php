<?php

namespace App\Repositories;

use App\Models\Contato;
use App\DTO\{CreateContatoDTO, UpdateContatoDTO};
use App\Repositories\ContatoRepositoryInterface;

class ContatoEloquentORM implements ContatoRepositoryInterface
{
    protected $model;

    public function __construct(Contato $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = null, string $etapaId = null): array
    {
        $query = $this->model->query();

        if ($etapaId) {
            $query->where('etapa_id', $etapaId);
        }

        if ($filter) {
            $query->where('name', 'like', "%$filter%");
        }

        return $query->get()->toArray();
    }

    public function findOne(string $id, string $etapaId): Contato|null
{
    return $this->model->where('id', $id)->where('etapa_id', $etapaId)->first();
}


    public function create(CreateContatoDTO $dto): Contato
    {
        $position = $this->model->where('etapa_id', $dto->etapa_id)->max('position') + 1;

        return $this->model->create([
            'name' => $dto->name,
            'etapa_id' => $dto->etapa_id,
            'telefone' => $dto->telefone,
            'email' => $dto->email,
            'data_de_nascimento' => $dto->data_de_nascimento,
            'valor' => $dto->valor,
            'ddd' => $dto->ddd,
            'cpf' => $dto->cpf,
            'position'=>$position,
            'endereco'=>$dto->endereco



        ]);
    }

    public function update(UpdateContatoDTO $dto): Contato|null
    {
        $contato = $this->model->find($dto->etapaId, $dto->id);

        if (!$contato) {
            return null;
        }

        $contato->update([
            'name' => $dto->name,
            'telefone' => $dto->telefone,
            'email' => $dto->email,
            'data_de_nascimento' => $dto->data_de_nascimento,
            'valor' => $dto->valor,
            'ddd' => $dto->ddd,
            'endereco' => $dto->endereco,
            
        ]);

        return $contato;
    }


    public function delete(string $id): void
    {
        $this->model->where('id',$id)->delete();
    }

    public function swap(string $contatoId, string $newPosition, string $etapaId): void
    {
        $contato = $this->model->find($contatoId);

        $contato->Update([
            'position' => $newPosition
        ]);

        $getPositions = $this->model->where('etapa_id', $etapaId)
            ->where('position','>=', $newPosition)
            ->where('id','!=',$contatoId)->get();


        foreach ($getPositions as $position){
                $position->update([
                'position' => $position->position+1
            ]);
            }
        }



    public function swapPhase(string $contatoId, string $newPosition, string $etapaId, string $newEtapaId): void
    {
        $contato = $this->model->find($contatoId);
        $oldPosition = $contato->position;
        $oldEtapaId = $contato->etapa_id;

        $getOldPositions = $this->model->where('etapa_id', $oldEtapaId)
            ->where('position','>=', $oldPosition)
            ->where('id','!=',$contatoId)->get();

        foreach ($getOldPositions as $position){
                $position->update([
                    'position' => $position->position-1
                ]);
            }


        $contato->Update([
            'etapa_id' => $newEtapaId,
            'position' => $newPosition
        ]);

        $getPositions = $this->model->where('etapa_id', $newEtapaId)
            ->where('position','=>', $newPosition)
            ->where('id','!=',$contatoId)->get();

        foreach ($getPositions as $position){

                $position->update([
                    'position' => $position->position+1
                ]);
            }
        }
}
