<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coproprietaire extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
}
