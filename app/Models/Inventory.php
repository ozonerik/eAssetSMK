<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'qrcode',
        'name',
        'description',
        'purchase_date',
        'purchase_price',
        'good_qty',
        'med_qty',
        'bad_qty',
        'lose_qty',
        'picture',
        'qrpicture',
        'budgeting_id',
        'fiscalyear_id',
        'itemtype_id',
        'storage_id',
        'organitation_id',
        'user_id',
    ];

    public function budgeting()
    {
        return $this->belongsTo(Budgeting::class);
    }

    public function fiscalyear()
    {
        return $this->belongsTo(Fiscalyear::class);
    }

    public function itemtype()
    {
        return $this->belongsTo(Itemtype::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function organitation()
    {
        return $this->belongsTo(Organitation::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
