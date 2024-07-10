<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class EtapaController extends Controller
{

  

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Etapa::all();
        return response()->json($users);
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
        $user = Etapa::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Etapa::findOrFail($id);
        $user->update($request->all());
      
        return response()->json($user->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Etapa::findOrFail($id);
        $user->delete();
        return response()->json(['msg' =>'Usuario deletado com sucesso!']);
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
