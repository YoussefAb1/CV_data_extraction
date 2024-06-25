<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberSyndic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function immeubles()
    {
        return $this->belongsToMany(Immeuble::class, 'immeuble_syndic')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }

    public function histories()
    {
        return $this->hasMany(SyndicHistory::class, 'syndic_id');
    }

    public function syndicHistories()
    {
        return $this->hasMany(SyndicHistory::class, 'syndic_id');
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
            return $this->hasMany(Appartement::class);
        }

        public function immeuble()
        {
            return $this->belongsTo(Immeuble::class, 'immeuble_id');
        }

}
