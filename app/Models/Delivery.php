<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'mr_no',
        'logistic_id',
        'type',
        'unique_code',
        'project_id',
        'project_name',
        'object_id',
        'delivery_to',
        'delivery_from',
        'mr_type',
        'site_name',
        'link_id',
        'delivery_address',
        'phone_no',
        'contact_person',
        'mode_of_delivery',
        'mode_of_transportation',
        'total_colly',
        'weight_all_material',
        'status',
        'receiver_name',
        'receiver_phone',
        'receiver_signature_url',
        'receiver_signature_path',
        'evidence_url',
        'evidence_path',
        'requested_by',
        'checked_by',
        'packed_by',
        'delivered_by',
        'date',
        'month',
        'year'
    ];


    protected $hidden = [
        'updated_at',
    ];
}