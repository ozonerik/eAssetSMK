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

}
