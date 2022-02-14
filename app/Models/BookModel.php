<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    use HasFactory;

    protected $table = 'book';

    protected $fillable = ["bookTitle","category","publicationDate","author","language","copiesActual","copiesCurrent","idShelf"];

    protected $primaryKey = 'idBook';
    public $timestamps = false;
}
