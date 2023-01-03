<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;
    protected $table = 'book_authors';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function author(){
        return $this->belongsTo(Author::class);
    }
    public $fillable = ['book_id','author_id'];
}
