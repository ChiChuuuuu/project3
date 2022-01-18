<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BBookModel extends Model
{
    use HasFactory;

    protected $table = 'borrowed_book';

    protected $primaryKey = 'idBB';
    public $timestamps = false;
}
