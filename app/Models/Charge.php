<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation', 'type', 'date', 'montant', 'description', 'appartement_id','statut'
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class, 'id_charge');
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }

    public function immeuble()
    {
        return $this->appartement->immeuble;
    }

    public function residence()
    {
        return $this->appartement->immeuble->residence;
    }

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }
}
