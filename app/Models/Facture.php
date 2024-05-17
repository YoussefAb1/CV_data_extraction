<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_facture', 'date_emission', 'date_echeance', 'montant_total', 'description', 'id_appartement', 'id_charge', 'etat'
    ];

    public function appartement()
    {
        return $this->belongsTo(Appartement::class, 'id_appartement');
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class, 'id_charge');
    }

    public function residence()
{
    return $this->belongsTo(Residence::class);
}



public function paiements()
{
    return $this->hasMany(Paiement::class);
}

}
