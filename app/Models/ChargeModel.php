<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeModel extends Model
{
    use HasFactory;

    protected $table = 'charge';

    protected $primaryKey = 'idCharge';
    public $timestamps = false;
}
