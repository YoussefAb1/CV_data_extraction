<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCoproprietaire extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cin', 'name', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coproprietaireHistories()
    {
        return $this->hasMany(CoproprietaireHistory::class);
    }

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function appartements()
    {
        return $this->hasMany(Appartement::class, 'member_coproprietaire_id');
    }
}
