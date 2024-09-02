<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

   
    protected $fillable = ['naziv', 'broj_sedista'];

    
    public function projekcije()
    {
        return $this->hasMany(Projekcija::class);
    }
}
