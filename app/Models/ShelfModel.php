<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelfModel extends Model
{
    use HasFactory;

    protected $table = 'shelf';

    protected $primaryKey = 'idShelf';
    public $timestamps = false;
}
