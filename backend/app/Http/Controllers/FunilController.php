<?php

namespace App\Http\Controllers;

use App\Models\Funil;
use Illuminate\Http\Request;

class FunilController extends Controller
{
  
    public function index()
    {
        $funis = Funil::all();
        return response()->json($funis); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $funil  = Funil::create($request->all());
        return response()->json($funil );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $funil  = Funil::find($id);
        return response()->json($funil );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $funil = Funil::findOrFail($id);
        $funil->update($request->all());
      
        return response()->json($funil->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $funil  = Funil::findOrFail($id);
        $funil ->delete();
        return response()->json(['msg' =>'Usuario deletado com sucesso!']);
    }
}
