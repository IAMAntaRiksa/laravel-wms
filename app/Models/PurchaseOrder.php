<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'warehouse_id',
        'month',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    protected function pdf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/pdf/purchase-order/' . $value),
        );
    }
}