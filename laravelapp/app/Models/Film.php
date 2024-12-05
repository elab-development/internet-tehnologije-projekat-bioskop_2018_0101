<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv', 
        'zanr', 
        'trajanje', 
        'opis', 
        'reziser', 
        'glumci', 
        'godina_izdanja', 
        'jezik', 
        'ocena', 
        'poster_url', 
        'trailer_url'
    ];

    public function projekcije()
    {
        return $this->hasMany(Projekcija::class);
    }
}
