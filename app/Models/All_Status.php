<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class All_Status extends Model
{
    use HasFactory;
    
    protected $table = 'all_status';

    protected $fillable = ['statusName','statusType'];
}
