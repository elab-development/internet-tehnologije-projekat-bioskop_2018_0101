<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FilmResource;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilmController extends Controller
{
    // Prikaz svih filmova sa mogućnošću pretrage
    public function index(Request $request)
    {
        // Preuzimamo sve parametre za pretragu
        $query = Film::query();

        // Provera parametara i dodavanje filtera
        if ($request->has('naziv')) {
            $query->where('naziv', 'like', '%' . $request->input('naziv') . '%');
        }

        if ($request->has('zanr')) {
            $query->where('zanr', 'like', '%' . $request->input('zanr') . '%');
        }

        if ($request->has('godina_izdanja')) {
            $query->where('godina_izdanja', $request->input('godina_izdanja'));
        }

        if ($request->has('jezik')) {
            $query->where('jezik', 'like', '%' . $request->input('jezik') . '%');
        }

        if ($request->has('reziser')) {
            $query->where('reziser', 'like', '%' . $request->input('reziser') . '%');
        }

        if ($request->has('ocena')) {
            $query->where('ocena', '>=', $request->input('ocena'));
        }

        // Dobavljanje rezultata
        $films = $query->get();

        // Vraćamo kolekciju filmova kao resurs
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
     // Generisanje CSV fajla sa svim filmovima
     public function exportCsv()
     {
         // Dohvatanje svih filmova iz baze podataka
         $films = Film::all();
 
         // Generisanje CSV podataka u memoriji
         $csvData = [];
 
         // Header red
         $csvData[] = ['Naziv', 'Žanr', 'Trajanje', 'Opis', 'Režiser', 'Glumci', 'Godina Izdanja', 'Jezik', 'Ocena', 'Poster URL', 'Trailer URL'];
 
         // Popunjavanje CSV podataka
         foreach ($films as $film) {
             $csvData[] = [
                 $film->naziv,
                 $film->zanr,
                 $film->trajanje,
                 $film->opis,
                 $film->reziser,
                 $film->glumci,
                 $film->godina_izdanja,
                 $film->jezik,
                 $film->ocena,
                 $film->poster_url,
                 $film->trailer_url,
             ];
         }
 
         // Kreiranje StreamedResponse za download CSV fajla
         $response = new StreamedResponse(function () use ($csvData) {
             $handle = fopen('php://output', 'w');
             foreach ($csvData as $row) {
                 fputcsv($handle, $row);
             }
             fclose($handle);
         });
 
         // Postavljanje headera za CSV
         $response->headers->set('Content-Type', 'text/csv');
         $response->headers->set('Content-Disposition', 'attachment; filename="svi_filmovi.csv"');
 
         return $response;
     }
}
