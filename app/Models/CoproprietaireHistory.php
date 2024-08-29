<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoproprietaireHistory extends Model
{
    use HasFactory;

    protected $fillable = ['coproprietaire_id', 'appartement_id', 'start_date', 'end_date'];

    public function coproprietaire()
    {
        return $this->belongsTo(MemberCoproprietaire::class, 'coproprietaire_id');
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class, 'appartement_id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'coproprietaire_history_id');
    }

}
