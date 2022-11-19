<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'external_code',
        'short_text',
        'item_number',
        'product_name',
        'unit'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function serial_numbers()
    {
        return $this->hasMany(SerialNumber::class);
    }
}