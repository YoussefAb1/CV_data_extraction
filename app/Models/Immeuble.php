<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function residence()
    {
        return $this->belongsTo(Residence::class, 'id_residence');
    }

    public function appartements()
{
    return $this->hasMany(Appartement::class);
}
}
