<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_reference_no',
        'is_open',
        'file_url',
        'file_path',
        'month',
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}