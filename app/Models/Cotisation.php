<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'date_cotisation',
        'appartement_id',
        'member_coproprietaire_id',
        'member_syndic_id',
        'description'
    ];

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

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }
}
