<?php

namespace App\Http\Controllers;

use App\Models\Projekcija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjekcijaResource;

class ProjekcijaController extends Controller
{
    // Prikaz svih projekcija
    public function index()
    {
        $projekcije = Projekcija::all();
        return ProjekcijaResource::collection($projekcije);
    }

    // Prikaz jedne projekcije
    public function show($id)
    {
        $projekcija = Projekcija::findOrFail($id);
        return new ProjekcijaResource($projekcija);
    }

    // Kreiranje nove projekcije
    public function store(Request $request)
    {
        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'film_id' => 'required|exists:films,id',
            'sala_id' => 'required|exists:salas,id',
            'datum_vreme' => 'required|date',
            'cena' => 'required|numeric|min:0',
            'broj_slobodnih_mesta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Kreiranje projekcije
        $projekcija = Projekcija::create($request->all());

        return new ProjekcijaResource($projekcija);
    }

    // Ažuriranje postojeće projekcije
    public function update(Request $request, $id)
    {
        // Pronalaženje projekcije
        $projekcija = Projekcija::findOrFail($id);

        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'film_id' => 'required|exists:films,id',
            'sala_id' => 'required|exists:salas,id',
            'datum_vreme' => 'required|date',
            'cena' => 'required|numeric|min:0',
            'broj_slobodnih_mesta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ažuriranje projekcije
        $projekcija->update($request->all());

        return new ProjekcijaResource($projekcija);
    }

    // Brisanje projekcije
    public function destroy($id)
    {
        $projekcija = Projekcija::findOrFail($id);
        $projekcija->delete();

        return response()->json(['message' => 'Projekcija deleted successfully'], 200);
    }
}
