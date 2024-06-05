<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;

    protected $fillable = ['nom_appartement', 'etage', 'surface', 'immeuble_id', 'residence_id'];

    public function immeuble()
    {
        return $this->belongsTo(Immeuble::class, 'immeuble_id');
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class, 'residence_id');
    }

    // public function memberCoproprietaire()
    // {
    //     return $this->belongsTo(MemberCoproprietaire::class, 'member_coproprietaire_id');
    // }

    public function memberCoproprietaire()
    {
        return $this->belongsTo(User::class, 'member_coproprietaire_id');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'appartement_id');
    }

    public function charges()
    {
        return $this->hasMany(Charge::class, 'appartement_id');
    }

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }

    public function coproprietaireHistories()
    {
        return $this->hasMany(CoproprietaireHistory::class);
    }
}
