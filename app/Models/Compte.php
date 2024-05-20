<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = ['numero_compte', 'solde', 'type'];

    public function compteable()
    {
        return $this->morphTo();
    }

    public function residence()
    {
        return $this->hasOne(Residence::class);
    }

    public function immeuble()
    {
        return $this->hasOne(Immeuble::class);
    }

    public function appartement()
    {
        return $this->hasOne(Appartement::class);
    }
}
