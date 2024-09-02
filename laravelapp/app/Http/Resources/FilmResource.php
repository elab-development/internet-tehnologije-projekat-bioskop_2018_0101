<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'zanr' => $this->zanr,
            'trajanje' => $this->trajanje,
            'opis' => $this->opis,
            'reziser' => $this->reziser,
            'glumci' => $this->glumci,
            'godina_izdanja' => $this->godina_izdanja,
            'jezik' => $this->jezik,
            'ocena' => $this->ocena,
            'poster_url' => $this->poster_url,
            'trailer_url' => $this->trailer_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'projekcije' => ProjekcijaResource::collection($this->whenLoaded('projekcije')), // Ako je veza učitana, prikazujemo projekcije
        ];
    }
}
