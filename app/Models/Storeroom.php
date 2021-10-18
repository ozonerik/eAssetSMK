<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storeroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'shortname',
        'roomname',
        'organitation_id',
        'user_id',
    ];

    public function organitation()
    {
        return $this->belongsTo(Organitation::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
    
}
