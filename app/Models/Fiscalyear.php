<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiscalyear extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'year',
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
}
