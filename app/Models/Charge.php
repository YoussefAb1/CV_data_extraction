<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation', 'type', 'date', 'montant', 'description', 'statut', 'id_appartement'
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class, 'id_charge');
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class, 'id_appartement');
    }

    public function residence(){
        return $this->belongsTo(Residence::class, 'id_residence');
    }


}
