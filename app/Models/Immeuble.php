<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_immeuble', 'nombre_etages', 'residence_id'
    ];

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

    public function syndics()
    {
        return $this->belongsToMany(MemberSyndic::class, 'immeuble_syndic')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }

    public function appartements()
    {
        return $this->hasMany(Appartement::class);
    }

<<<<<<< HEAD
=======
    // public function memberSyndic()
    // {
    //     return $this->belongsTo(MemberSyndic::class, 'member_syndic_id');
    // }

    public function memberSyndic()
    {
        return $this->belongsTo(User::class, 'member_syndic_id');
    }
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364

    public function compte()
    {
        return $this->morphOne(Compte::class, 'compteable');
    }

    public function syndicHistories()
{
    return $this->hasMany(syndicHistory::class);
}


public function currentSyndic()
{
    return $this->hasOne(SyndicHistory::class)->whereNull('end_date')->latest('start_date');
}
}
