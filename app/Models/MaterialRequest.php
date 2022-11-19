<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'no_picking',
        'project_id',
        'project_name',
        'mr_no',
        'mr_date',
        'status_mr_header',
        'remarks',
        'object_id',
        'object_type',
        'object_parent_id',
        'object_parent_type',
        'project_definition',
        'wbs_element',
        'order',
        'site_id_ne',
        'site_name',
        'link_id',
        'network',
        'ne_fe',
        'im_no',
        'order_reference_no',
        'status_sn',
        'order_qty',
        'unit',
        'system_config',
        'storage_location',
        'type',
        'functional_location',
        'description',
        'purpose',
        'delivery_from',
        'delivery_to',
        'region',
        'delivery_address',
        'kecamatan',
        'kabupaten',
        'propinsi',
        'contact_person',
        'phone_no',
        'eta',
        'plan_mode_of_delivery',
        'requested_by',
        'prepared_by',
        'dr_no',
        'batch_number',
        'lot',
        'etd',
        'dn_no',
        'sto_no',
        'boq_no',
        'month',
    ];
}