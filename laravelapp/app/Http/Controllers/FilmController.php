<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FilmResource;

class FilmController extends Controller
{
    // Prikaz svih filmova
    public function index()
    {
        $films = Film::all();
        return FilmResource::collection($films);
    }

    // Prikaz jednog filma
    public function show($id)
    {
        $film = Film::findOrFail($id);
        return new FilmResource($film);
    }

    // Kreiranje novog filma
    public function store(Request $request)
    {
        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'zanr' => 'required|string|max:255',
            'trajanje' => 'required|integer|min:1',
            'opis' => 'required|string',
            'reziser' => 'required|string|max:255',
            'glumci' => 'nullable|string',
            'godina_izdanja' => 'required|integer|min:1800|max:' . date('Y'),
            'jezik' => 'required|string|max:100',
            'ocena' => 'nullable|numeric|min:0|max:10',
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Kreiranje filma
        $film = Film::create($request->all());

        return new FilmResource($film);
    }

    // Ažuriranje postojećeg filma
    public function update(Request $request, $id)
    {
        // Pronalaženje filma
        $film = Film::findOrFail($id);

        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'zanr' => 'required|string|max:255',
            'trajanje' => 'required|integer|min:1',
            'opis' => 'required|string',
            'reziser' => 'required|string|max:255',
            'glumci' => 'nullable|string',
            'godina_izdanja' => 'required|integer|min:1800|max:' . date('Y'),
            'jezik' => 'required|string|max:100',
            'ocena' => 'nullable|numeric|min:0|max:10',
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ažuriranje filma
        $film->update($request->all());

        return new FilmResource($film);
    }

    // Brisanje filma
    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return response()->json(['message' => 'Film deleted successfully'], 200);
    }
}
