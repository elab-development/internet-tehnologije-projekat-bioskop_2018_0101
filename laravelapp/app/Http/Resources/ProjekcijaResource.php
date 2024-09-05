<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjekcijaResource extends JsonResource
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
            'film_id' => $this->film_id,
            'film' => new FilmResource($this->film), // Prikazivanje informacija o filmu ako su učitane
            'sala_id' => $this->sala_id,
            'sala' => new SalaResource($this->sala ), // Prikazivanje informacija o sali ako su učitane
            'datum_vreme' => $this->datum_vreme,
            'cena' => $this->cena,
            'broj_slobodnih_mesta' => $this->broj_slobodnih_mesta,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

