<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function immeuble()
{
    return $this->belongsTo(Immeuble::class, 'id_immeuble');


}

public function coproprietaire()
{
    return $this->belongsTo(Coproprietaire::class);
}


protected $fillable = [
    'nom_appartement', // autres champs
];

public function factures()
{
    return $this->hasMany(Facture::class, 'id_appartement');
}

public function charges()
{
    return $this->hasMany(Charge::class, 'id_appartement');
}
}
