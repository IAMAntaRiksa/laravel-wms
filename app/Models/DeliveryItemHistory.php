<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItemHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'status',
        'action_by',
    ];
}