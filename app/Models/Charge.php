<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation', 'type', 'date', 'montant', 'description', 'statut', 'appartement_id'
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class, 'id_charge');
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class, 'appartement_id');
    }

    public function immeuble()
    {
        return $this->belongsTo(Immeuble::class, 'appartement_id');
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class, 'appartement_id');
    }

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }
}
