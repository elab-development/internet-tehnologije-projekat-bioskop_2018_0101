<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SalaResource;

class SalaController extends Controller
{
    // Prikaz svih sala
    public function index()
    {
        $sale = Sala::all();
        return SalaResource::collection($sale);
    }

    // Prikaz jedne sale
    public function show($id)
    {
        $sala = Sala::findOrFail($id);
        return new SalaResource($sala);
    }

    // Kreiranje nove sale
    public function store(Request $request)
    {
        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'broj_sedista' => 'required|integer|min:1',
            'vrsta_sale' => 'required|string|max:255',
            'oprema' => 'nullable|string',
            'dostupnost' => 'required|boolean',
            'napomena' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Kreiranje nove sale
        $sala = Sala::create($request->all());

        return new SalaResource($sala);
    }

    // Ažuriranje postojeće sale
    public function update(Request $request, $id)
    {
        // Pronalaženje sale
        $sala = Sala::findOrFail($id);

        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'broj_sedista' => 'required|integer|min:1',
            'vrsta_sale' => 'required|string|max:255',
            'oprema' => 'nullable|string',
            'dostupnost' => 'required|boolean',
            'napomena' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ažuriranje sale
        $sala->update($request->all());

        return new SalaResource($sala);
    }

    // Brisanje sale
    public function destroy($id)
    {
        $sala = Sala::findOrFail($id);
        $sala->delete();

        return response()->json(['message' => 'Sala deleted successfully'], 200);
    }
}
