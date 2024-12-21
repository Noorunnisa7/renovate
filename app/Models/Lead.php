<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // Define the table associated with the model (if not using plural form)
    protected $table = 'leads';

    // Define the fillable attributes
    protected $fillable = [
        'mobile_no',
        'customer_name',
        'customer_city',
        'customer_address',
        'lead_status',
        'assigned_lead',
        'source',
        'remarks',
        'lead_img',
    ];

}
