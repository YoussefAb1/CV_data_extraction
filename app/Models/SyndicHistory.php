<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyndicHistory extends Model
{
    use HasFactory;

    
    protected $fillable = ['syndic_id', 'immeuble_id', 'start_date', 'end_date'];


    public function syndic()
    {
        return $this->belongsTo(MemberSyndic::class, 'syndic_id');
    }

    public function immeuble()
    {
        return $this->belongsTo(Immeuble::class, 'immeuble_id');
    }


    public function memberSyndic()
    {
        return $this->belongsTo(MemberSyndic::class, 'syndic_id');
    }
}
