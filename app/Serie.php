<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/*
Eloquent = é uma ferramenta de RM de mapeamento de um modelo orientado a objetado para um modelo relacional.
*/

class Serie extends Model {
    public $timestamps = false;
    protected $fillable = ['nome'];

    /*
        Informa que a serie tem muitas temporadas
    */
    public function temporadas() {
        return $this->hasMany(Temporada::class);
    }
}
