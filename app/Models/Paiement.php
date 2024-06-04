<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'date_paiement',
        'methode_paiement',
        'coproprietaire_history_id',
        'syndic_history_id',
        'cotisation_id',
    ];

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }

    public function memberCoproprietaire()
    {
        return $this->belongsTo(MemberCoproprietaire::class, 'member_coproprietaire_id');
    }

    public function memberSyndic()
    {
        return $this->belongsTo(MemberSyndic::class, 'member_syndic_id');
    }

    public function cotisation()
    {
        return $this->belongsTo(Cotisation::class, 'cotisation_id');
    }

    public function coproprietaireHistory()
    {
        return $this->belongsTo(CoproprietaireHistory::class, 'coproprietaire_history_id');
    }

    public function syndicHistory()
    {
        return $this->belongsTo(SyndicHistory::class, 'syndic_history_id');
    }
}
