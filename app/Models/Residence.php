<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = ['nom_residence', 'adresse_residence'];

    public function immeubles()
    {
        return $this->hasMany(Immeuble::class);
    }

    public function appartements()
    {
        return $this->hasManyThrough(Appartement::class, Immeuble::class);
    }

    public function factures()
    {
        return $this->hasManyThrough(Facture::class, Appartement::class);
    }

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }
}
