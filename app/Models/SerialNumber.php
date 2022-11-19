<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'serial_number',
        'in_date',
        'out_date',
        'mr_no',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}