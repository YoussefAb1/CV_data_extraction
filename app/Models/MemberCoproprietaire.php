<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCoproprietaire extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cin', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

      public function appartements()
{
    return $this->hasMany(Appartement::class, 'member_coproprietaire_id');
}


}
