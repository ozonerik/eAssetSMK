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
        'unit',
        'good_qty',
        'med_qty',
        'bad_qty',
        'lost_qty',
        'picture',
        'qrpicture',
        'qrcheck',
        'budgeting_id',
        'fiscalyear_id',
        'itemtype_id',
        'storeroom_id',
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

    public function storeroom()
    {
        return $this->belongsTo(Storeroom::class);
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
