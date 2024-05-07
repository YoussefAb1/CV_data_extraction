<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function immeubles()
    {
        return $this->hasMany(Immeuble::class, 'id_residence');
    }
}
