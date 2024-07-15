<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($funilId)
    {
        $etapas = Etapa::where('funil_id', $funilId)->get();
        return response()->json($etapas);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$funilId)
    {
        $etapa = Etapa::create([
            'funil_id' => $funilId,
            'name' => $request->name,
            'position' => $request->position
        ]);
        return response()->json($etapa, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etapa = Etapa::find($id);
        return response()->json($etapa);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idFunil, string $id)
    {
        $etapa = Etapa::findOrFail($id);
        $etapa->update($request->all());
      
        return response()->json($etapa->fresh());
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idFunil, string $id)
    {
        $etapa = Etapa::find($id);
        

        if (!$etapa) {
            return response()->json(['error' => 'Etapa não encontrada'], 404);
        }
    
        $etapa->delete();
    
        return response()->json(['msg' =>'Etapa deletada com sucesso!']);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'etapas' => 'required|array'
        ]);
        foreach ($request->etapas as $etapa) {
            Etapa::where('id', $etapa['id'])->update(['position' => $etapa['position']]);
        }
        return response()->json(['message' => 'Order updated successfully']);
    }
}
