<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'numero_facture',
        'appartement_id',
        'member_coproprietaire_id',
        'member_syndic_id',
        'charge_id',
        'date_emission',
        'date_echeance',
        'montant_total',
        'description',
        'etat'
    ];

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class, 'appartement_id');
    }

    public function memberCoproprietaire()
    {
        return $this->belongsTo(MemberCoproprietaire::class, 'member_coproprietaire_id');
    }

    public function memberSyndic()
    {
        return $this->belongsTo(MemberSyndic::class, 'member_syndic_id');
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class, 'charge_id');
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'facture_id');
    }
}


