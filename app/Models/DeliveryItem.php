<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'order_reference_no',
        'item_id',
        'qty',
        'is_manual',
        'sloc',
        'unit',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}