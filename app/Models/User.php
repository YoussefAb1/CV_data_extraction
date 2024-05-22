<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'phone',
        'adresse',
        'role',
        'status'
    ];

    public function appartements()
    {
        return $this->hasMany(Appartement::class);
    }

    public function memberCoproprietaire()
    {
        return $this->hasOne(MemberCoproprietaire::class);
    }

    public function memberSyndic()
    {
        return $this->hasOne(MemberSyndic::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getPermissionGroups() {
        return Permission::select('group_name')
                         ->groupBy('group_name')
                         ->get();
    }
}
