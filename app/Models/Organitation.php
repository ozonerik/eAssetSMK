<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'shortname',
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function budgeting()
    {
        return $this->hasMany(Budgeting::class);
    }

    public function fiscalyear()
    {
        return $this->hasMany(Fiscalyear::class);
    }

}
