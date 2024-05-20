<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;

    protected $fillable = ['nom_immeuble', 'nombre_etages', 'residence_id', 'member_syndic_id'];

    public function residence()
    {
        return $this->belongsTo(Residence::class, 'residence_id');
    }

    public function appartements()
    {
        return $this->hasMany(Appartement::class);
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
