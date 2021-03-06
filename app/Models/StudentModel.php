<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $primaryKey = 'idStudent';

    protected $fillable = ["name","dob","gender","department","phone","idStatus","expiredDate"];

    public $timestamps = false;
}
