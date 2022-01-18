<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $primaryKey = 'idAuthor';
    public $timestamps = false;
}
