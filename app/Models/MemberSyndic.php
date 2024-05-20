<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberSyndic extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cin', 'date_affectation', 'date_fin', 'immeuble_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function immeuble()
    {
        return $this->hasOne(Immeuble::class);
    }
}
