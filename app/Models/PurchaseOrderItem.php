<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'item_id',
        'qty_incoming',
        'qty_arrived',
        'incoming_plan',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}