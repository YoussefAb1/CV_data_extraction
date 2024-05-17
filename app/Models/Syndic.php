<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syndic extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }



    public function immeubles()
    {
        return $this->hasMany(Immeuble::class);
    }
}
