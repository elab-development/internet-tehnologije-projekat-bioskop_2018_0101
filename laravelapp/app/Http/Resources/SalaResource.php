<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaResource extends JsonResource
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
            'broj_sedista' => $this->broj_sedista,
            'vrsta_sale' => $this->vrsta_sale,
            'oprema' => $this->oprema,
            'dostupnost' => $this->dostupnost,
            'napomena' => $this->napomena,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'projekcije' => ProjekcijaResource::collection($this->whenLoaded('projekcije')), // Prikazivanje projekcija ako su učitane
        ];
    }
}
