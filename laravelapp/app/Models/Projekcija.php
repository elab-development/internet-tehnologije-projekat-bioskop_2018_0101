<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projekcija extends Model
{
    use HasFactory;

  
    protected $fillable = ['film_id', 'sala_id', 'datum_vreme'];

   
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

     
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
