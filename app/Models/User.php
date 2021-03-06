<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organitation_id'
    ];

    public function organitation()
    {
        return $this->belongsTo(Organitation::class);
    }

    public function budgeting()
    {
        return $this->hasMany(Budgeting::class);
    }

    public function fiscalyear()
    {
        return $this->hasMany(Fiscalyear::class);
    }

    public function itemtype()
    {
        return $this->hasMany(Itemtype::class);
    }

    public function storeroom()
    {
        return $this->hasMany(Storeroom::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
